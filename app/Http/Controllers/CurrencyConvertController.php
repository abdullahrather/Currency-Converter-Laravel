<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class CurrencyConvertController extends Controller
{
    protected $client;

    public function __construct()
    {
        // Initialize GuzzleHttp Client with base URI and options
        $this->client = new Client([
            'base_uri' => 'https://v6.exchangerate-api.com/v6/5cc908376f994c93a74f0d43/',
            'timeout'  => 2.0,
            'verify' => base_path('certificates/cacert.pem'),
        ]);
    }

    public function index()
    {
        // Fetch latest currency rates using ExchangeRateApi
        $response = $this->client->request('GET', 'latest/USD');
        $rates = json_decode($response->getBody()->getContents(), true)['conversion_rates'];

        // Pass currency rates to the view
        return view('index', compact('rates'));
    }

    public function convert(Request $request)
    {
        // Validate user input
        $request->validate([
            'amount' => 'numeric|min:0',
            'from' => 'required',
            'to' => 'required',
        ]);

        // Fetch currency conversion using ExchangeRateApi
        $response = $this->client->request('GET', 'pair/' . $request->from . '/' . $request->to . '/' . $request->amount);
        $converted = json_decode($response->getBody()->getContents(), true)['conversion_result'];

        // Prepare conversion message
        $conversionMessage = "{$request->amount} {$request->from} is equal to {$converted} {$request->to}";

        // Redirect back with conversion message and input data
        return back()->with([
            'conversion' => $conversionMessage
        ])->withInput();
    }
}
