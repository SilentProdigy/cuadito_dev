<?php

use Facade\FlareClient\Http\Exceptions\BadResponseCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::post('test-payment', function(Request $request) {
//     Log::info($request);
//     return response()->json(['result' => 'OK']);
// });

Route::post('payment', [\App\Http\Controllers\API\PaymentController::class, 'store'])->name('payment.store');