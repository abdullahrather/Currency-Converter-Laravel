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
    $this->client = new Client([
      'base_uri' => 'https://v6.exchangerate-api.com/v6/5cc908376f994c93a74f0d43/',
      'timeout'  => 2.0,
      'verify'   => storage_path('app/cacert.pem'),
    ]);
  }

  public function index()
  {
    // Fetch currencies using ExchangeRateApi
    $response = $this->client->request('GET', 'latest/USD');
    $rates = json_decode($response->getBody()->getContents(), true)['conversion_rates'];

    return view('index', compact('rates'));
  }

  public function convert(Request $request)
  {
    $request->validate([
      'amount' => 'numeric|min:0',
      'from' => 'required',
      'to' => 'required',
    ]);

    // Fetch conversion using ExchangeRateApi
    $response = $this->client->request('GET', 'pair/' . $request->from . '/' . $request->to . '/' . $request->amount);
    $converted = json_decode($response->getBody()->getContents(), true)['conversion_result'];

    $conversionMessage = "{$request->amount} {$request->from} is equal to {$converted} {$request->to}";

    return back()->with([
      'conversion' => $conversionMessage
    ])->withInput(); // Ensure the input data is flashed to the session
  }
}
