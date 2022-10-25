
<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignupController;

Route::post('/user/signup', [AccountController::class,'store'])->middleware('IpCheckAndAllow');
Route::post('/user/login', [AccountController::class,'login'])->middleware('IpCheckAndAllow');

