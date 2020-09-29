<?php
/**
 * Created by PhpStorm.
 * User: celldweller
 * Date: 2020-09-29
 * Time: 11:30
 */

namespace App\Services;


use App\Model\Money;
use App\Model\MoneyWon;
use App\Services\Interfaces\ProcessServiceInterface;
use Illuminate\Support\Facades\Auth;

class MoneyService implements ProcessServiceInterface
{

    const SEND_TO_BANK = 'send_to_bank';

    const TRANSFER_TO_BONUS = 'convert_to_bonus';

    private $moneyModel;

    private $moneyWon;

    public function __construct(Money $moneyModel, MoneyWon $moneyWon) {
        $this->moneyModel = $moneyModel;
        $this->moneyWon = $moneyWon;
    }

    public function handleFirstAttempt() {

        $totalBalance = $this->moneyModel::all()->last()->amount;

        if ($totalBalance >= 10) {
            $randomWonValue = mt_rand(10, $totalBalance);
            $this->updateTotalAmount($randomWonValue, $totalBalance);
            $this->writeWonHistory($randomWonValue);

            return $randomWonValue;
        } else {
            return 'Try again';
        }
    }

    public function handleDecision($params) {
        if ($params === self::SEND_TO_BANK) {
            $this->updateWonHistory('transfer_to_bank');
            return 'Your prize will send to your bank acoount soon';
        }

        if ($params === self::TRANSFER_TO_BONUS) {
            /* Logic for transfer here */
            /* Update bonus_points table */
            $this->updateWonHistory('transfer_to_bonus_point');
            return 'Your prize has convert to bonus points';
        }

    }

    private function updateTotalAmount($randomWonValue, $totalBalance) {
        try {
            $remainBalance = $totalBalance - $randomWonValue;
            $this->moneyModel->amount = $remainBalance;
            $this->moneyModel->save();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    private function writeWonHistory($amount) {
        $this->moneyWon->amount = $amount;
        $this->moneyWon->user_id = Auth::user()->id;
        $this->moneyWon->save();
    }

    private function updateWonHistory($decisionType) {
        $lastItem = $this->moneyWon::where('user_id', '=', Auth::user()->id)->orderBy('updated_at', 'desc')->first();
        $lastItem->{$decisionType} = 1;
        $lastItem->update();
        return;
    }
}