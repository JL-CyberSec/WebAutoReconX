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
    // $url = config('scan.fastapi_uri') . "/system-info";
    // $response = Http::get($url);
    // $data = $response->json();
    // dd($data);

    // $url = config('scan.fastapi_uri') . "/interfaces";
    // $response = Http::get($url);
    // $data = $response->json();
    // dd($data);

    // $url = config('scan.fastapi_uri') . "/firewall";
    // $response = Http::get($url);
    // $data = $response->json();
    // dd($data);

    $url = config('scan.fastapi_uri') . "/hosts/5";
    $response = Http::timeout(120)->get($url);
    $data = $response->json();
    dd($data);
});
