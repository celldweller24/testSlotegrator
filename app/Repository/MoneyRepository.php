<?php
/**
 * Created by PhpStorm.
 * User: celldweller
 * Date: 2020-09-28
 * Time: 22:26
 */

namespace App\Repository;

use App\Model\Money;
use App\Repository\Interfaces\LimitRepositoryInterface;


class MoneyRepository implements LimitRepositoryInterface
{

    public function checkLimit() {
        return Money::where('amount', '>', 10)->orderBy('updated_at', 'desc')->first();
    }
}