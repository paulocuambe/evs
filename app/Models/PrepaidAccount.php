<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrepaidAccount extends Model
{
    use HasFactory;

    protected $connection = "credit";
    protected $table = "prepaid_account";
}
