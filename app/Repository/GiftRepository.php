<?php
/**
 * Created by PhpStorm.
 * User: celldweller
 * Date: 2020-09-29
 * Time: 10:46
 */

namespace App\Repository;


use App\Model\Gifts;
use App\Repository\Interfaces\LimitRepositoryInterface;

class GiftRepository implements LimitRepositoryInterface
{

    public function checkLimit() {
        return Gifts::where('amount', '>', 0)->orderBy('updated_at', 'desc')->first();
    }
}