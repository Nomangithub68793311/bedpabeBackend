
<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

Route::post('/user/signup', [AccountController::class,'store'])->middleware('IpCheckAndAllow');
Route::get('/signup/verify/{id}', [AccountController::class,'verifyEmail'])->middleware('IpCheckAndAllow');
Route::get('/signup/check', [AccountController::class,'check'])->middleware('IpCheckAndAllow');

Route::post('/user/login', [AccountController::class,'login'])->middleware('IpCheckAndAllow');
// Route::post('/user/login', [AccountController::class,'login'])->middleware('throttle:3,1');

