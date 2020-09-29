<?php
/**
 * Created by PhpStorm.
 * User: celldweller
 * Date: 2020-09-29
 * Time: 11:30
 */

namespace App\Services;


use App\Services\Interfaces\ProcessServiceInterface;

class BonusPoinsService implements ProcessServiceInterface
{
    public function handleFirstAttempt() {
        return;
    }

    public function handleDecision($params) {
        return;
    }
}