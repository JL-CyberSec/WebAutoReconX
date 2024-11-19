<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/test', function() {
    // $url = env('FAST_API_URL') . "/system-info";
    // $response = Http::get($url);
    // $data = $response->json();
    // dd($data);

    // $url = env('FAST_API_URL') . "/interfaces";
    // $response = Http::get($url);
    // $data = $response->json();
    // dd($data);

    // $url = env('FAST_API_URL') . "/firewall";
    // $response = Http::get($url);
    // $data = $response->json();
    // dd($data);

    $url = env('FAST_API_URL') . "/hosts";
    $response = Http::timeout(120)->get($url);
    $data = $response->json();
    dd($data);
});
