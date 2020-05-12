<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RechargesController extends Controller
{
    public function index()
    {
        return view('recharges.index');
    }
}
