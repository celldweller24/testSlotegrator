<?php

namespace App\Http\Controllers;

use App\Services\LoterryService;
use Illuminate\Http\Request;

class ProcessController extends Controller
{

    protected $loterryService;


    public function __construct(LoterryService $loterryService) {
        $this->loterryService = $loterryService;
    }


    public function index() {
        $response = $this->loterryService->processFirstAttepmt();
        return redirect()->action(ucfirst($response['prizeType']) . 'WonController@index', $response);
    }
}
