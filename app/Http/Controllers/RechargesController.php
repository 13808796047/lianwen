<?php

namespace App\Http\Controllers;

use App\Models\Recharge;
use Illuminate\Http\Request;

class RechargesController extends Controller
{
    public function index()
    {
        return view('domained::recharges.index');
    }

    public function show(Recharge $recharge)
    {
        return view('domained::recharges.show', compact('recharge'));
    }
}
