<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MoneyWon extends Model
{
    protected $fillable = ['amount', 'user_id', 'transfer_to_bank', 'transfer_to_bonus_point'];
}
