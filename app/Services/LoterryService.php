<?php

namespace App\Services;


class LoterryService
{

    private $processLoterry;

    public function __construct(ProcessLoterry $processLoterry) {
        $this->processLoterry = $processLoterry;
    }

    public function getRandomLotteryType() {
        $loterryTypes = $this->processLoterry->getCurrentLoterries();
        $randomLoterryValue = array_rand($loterryTypes, 1);

        return $loterryTypes[$randomLoterryValue];
    }

    public function processFirstAttepmt() {
        $loteryType = $this->getRandomLotteryType();
        $currentLoterryService = $this->processLoterry->getCurrentService($loteryType);

        return [
            'prizeType' => $loteryType,
            'wonPrizeValue' => $currentLoterryService->handleFirstAttempt()
        ];
    }

    public function processCurrentLoterry(string $currentLoterry, $params) {
        $this->processLoterry->getCurrentService($currentLoterry)->handleDecision($params);
    }
}