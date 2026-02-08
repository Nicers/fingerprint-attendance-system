<?php

use App\Http\Controllers\ZktecoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use Illuminate\Support\Facades\Http;

Route::get('api-testing', function () {

    $endpoint = 'https://api-courier-prodaus.skipthedishes.com/v1/couriers/login';

    $response = Http::withHeaders([
        'app-token'        => 'YOUR_APP_TOKEN',
        'content-type'     => 'application/json',
        'platform-version' => '1.0',
        'app-version'      => '1.0.0',
        'app-build'        => '100',
        'platform'         => 'web',
        'user-agent'       => 'Laravel-API-Test',
    ])->post($endpoint, [
        'email'    => 'lucasuberuk22@outlook.com',
        'password' => 'Brink1522!',
    ]);

    if ($response->failed()) {
        return response()->json([
            'status' => 'error',
            'code'   => $response->status(),
            'body'   => $response->body(),
        ], $response->status());
    }

    return response()->json($response->json());
});


// Add this to routes/web.php temporarily
Route::get('/test-device', function () {
    $ip = '110.93.226.240';
    $zk = new \Rats\Zkteco\Lib\ZKTeco($ip);
    
    if ($zk->connect()) {
        $version = $zk->version();
        dd($zk);
        return "Success! Connected to device. Firmware Version: " . $version;
    } else {
        return "Failed to connect to " . $ip;
    }
});



Route::get('/zkteco/sync', [ZktecoController::class, 'sync']);
