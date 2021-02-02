<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = "transaction";

    public function scopeStatus($query, $status)
    {
        return $query->where('transacStatus', '=', $status);
    }

    public function dealer()
    {
        return $this->hasOne(Dealer::class, 'id', 'dealer_id');
    }
}
