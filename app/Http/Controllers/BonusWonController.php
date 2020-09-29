<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BonusWonController extends Controller
{
    public function index() {
        return view('bonus');
    }
}
