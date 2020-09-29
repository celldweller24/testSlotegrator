<?php
/**
 * Created by PhpStorm.
 * User: celldweller
 * Date: 2020-09-29
 * Time: 13:18
 */

namespace App\Services\Interfaces;


interface ProcessServiceInterface
{
    public function handleFirstAttempt();

    public function handleDecision($params);
}