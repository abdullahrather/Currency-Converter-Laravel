<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrencyConvertController extends Controller
{
    // This method returns the view named "index". | Documented by Abdullah Rather
    public function index()
    {
        return view('index');
    }
    // debug
    public function convert()
    {
        dd('test');
    }
}
