<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Services\OpenAI;

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
    $fastapiUri = config('scan.fastapi_uri');

    $openAI = new OpenAI;

    $url = "$fastapiUri/system-info";
    $response = Http::get($url);
    $data = $response->json();
    dump($data);
    dump($openAI->chat(json_encode($data)));

    $url = "$fastapiUri/interfaces";
    $response = Http::get($url);
    $data = $response->json();
    dump($data);
    dump($openAI->chat(json_encode($data)));

    $url = "$fastapiUri/firewall";
    $response = Http::get($url);
    $data = $response->json();
    dump($data);
    dump($openAI->chat(json_encode($data)));

    $url = "$fastapiUri/hosts/5";
    $response = Http::timeout(0)->get($url);
    $data = $response->json();
    dump($data);
    dump($openAI->chat(json_encode($data)));

});
