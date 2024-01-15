<?php

use App\Http\Controllers\ApiBerandaClientController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BerandaClientController;
use App\Http\Controllers\SkyMemberController;
use App\Http\Controllers\SkyMemberPembayaranController;
use App\Http\Controllers\SkyMemberProfileController;
use App\Http\Controllers\SkyMemberTagihanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [LoginController::class, 'loginApi']);

Route::prefix('client')->middleware(['auth:sanctum', 'auth.client'])->group(
    function() {
        // Rroute Khusus Client
        Route::get('beranda', [ApiBerandaClientController::class, 'index']);
        // Route::apiResource('member', SkyMemberController::class);
        // Route::resource('tagihan', SkyMemberTagihanController::class);
        // Route::resource('pembayaran', SkyMemberPembayaranController::class);
        // Route::resource('profil', SkyMemberProfileController::class);
    }
);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
