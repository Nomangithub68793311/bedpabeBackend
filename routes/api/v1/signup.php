
<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignupController;

Route::post('/user/signup', [SignupController::class,'store'])->middleware('IpCheckAndAllow');
Route::post('/user/login', [SignupController::class,'login'])->middleware('IpCheckAndAllow');

