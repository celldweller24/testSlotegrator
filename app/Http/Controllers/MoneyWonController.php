<?php
/**
 * Created by PhpStorm.
 * User: celldweller
 * Date: 2020-09-29
 * Time: 16:32
 */

namespace App\Http\Controllers;

use App\Services\LoterryService;


class MoneyWonController extends Controller
{
    protected $loterryService;


    public function __construct(LoterryService $loterryService) {
        $this->loterryService = $loterryService;
    }

    public function index() {
        if (request('send_to_bank') || request('convert_to_bonus')) {
            $decision = request('send_to_bank') ?? request('convert_to_bonus');
            $response = $this->loterryService->processCurrentLoterry(request('prize_type'), $decision);
            return view('money', $response);
        }

        return view('money', ['wonPrizeValue' => request('wonPrizeValue'), 'prizeType' => request('prizeType')]);
    }
}