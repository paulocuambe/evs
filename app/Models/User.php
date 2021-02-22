<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $pagination = 20;

    public function subusers()
    {
        return $this->hasMany(User::class, 'parent_id');
    }

    public function organization(){
        return $this->belongsTo(Organization::class);
    }

    public function scopeSysAdmin($query, $bool=true)
    {
        if ($bool) {
            return $query->where('role', '=', 'super_admin')->where('id', '=', 1);
        }
        return $query->where('role', '!=', 'super_admin')->where('id', '!=', 1);
    }

    public function scopeSuperAdmin($query, $bool=true)
    {
        return $bool ? $query->where('role', '=', 'super_admin'): $query->where('role', '!=', 'super_admin');
    }

    public function scopeAdmin($query)
    {
        return $query->where('role', '=', 'admin');
    }

    public function isNormal()
    {
        return $this->role == "normal";
    }

    public function isAdmin()
    {
        return $this->role == "admin";
    }

    public function disable()
    {
        $this->suspended = true;
        return $this->update();
    }

    public function enable()
    {
        $this->suspended = false;
        return $this->update();
    }

    public function isSuperAdmin()
    {
        return $this->role == "super_admin";
    }

    public function isSysAdmin()
    {
        return $this->role == "super_admin" && $this->id == 1;
    }

    public function getFirstNameAttribute()
    {
        return explode(" ", $this->name)[0];
    }

    public function getLastNameAttribute()
    {
        return explode(" ", $this->name)[1];
    }
}
