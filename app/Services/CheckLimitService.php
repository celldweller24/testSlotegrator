<?php
/**
 * Created by PhpStorm.
 * User: celldweller
 * Date: 2020-09-29
 * Time: 12:46
 */

namespace App\Services;

use App\Repository\Interfaces\LimitRepositoryInterface;

class CheckLimitService
{

    public function checkLoterryLimit(LimitRepositoryInterface $limitRepository) {
        return $limitRepository->checkLimit();
    }
}