<?php
/**
 * Created by PhpStorm.
 * User: celldweller
 * Date: 2020-09-29
 * Time: 11:36
 */

namespace App\Services;

use App\Repository\GiftRepository;
use App\Repository\MoneyRepository;
use App\Services\Interfaces\ProcessServiceInterface;

class ProcessLoterry
{
    const MONEY = 'money';

    const BONUS = 'bonus';

    const GIFT = 'gift';

    private $checkLimitService;

    protected $moneyService;

    protected $bonusPoinsService;

    protected $giftService;

    public function __construct(
        CheckLimitService $checkLimitService,
        MoneyService $moneyService,
        BonusPoinsService $bonusPoinsService,
        GiftService $giftService
    ) {
        $this->checkLimitService = $checkLimitService;
        $this->moneyService = $moneyService;
        $this->bonusPoinsService = $bonusPoinsService;
        $this->giftService = $giftService;
    }

    public function getAllLoterryTypes() {
        return [self::MONEY, self::BONUS, self::GIFT];
    }

    public function getCurrentLoterries() {
        $loterryTypes = $this->getAllLoterryTypes();

        foreach ($loterryTypes as $key => $lotteryType) {
            if($lotteryType === self::MONEY) {
                if(is_null($this->checkLimitService->checkLoterryLimit(new MoneyRepository()))) {
                    unset($loterryTypes[$key]);
                }

                if($lotteryType === self::GIFT) {
                    if(is_null($this->checkLimitService->checkLoterryLimit(new GiftRepository()))) {
                        unset($loterryTypes[$key]);
                    }
                }
            }
        }

        return $loterryTypes;
    }


    /*  Refactor to Factory pattern */
    public function getCurrentService(string $loterryType) : ProcessServiceInterface {
        switch ($loterryType) {
            case self::MONEY:
                return $this->moneyService;
            case self::BONUS:
                return $this->bonusPoinsService;
            case self::GIFT:
                return $this->giftService;
        }
    }
}