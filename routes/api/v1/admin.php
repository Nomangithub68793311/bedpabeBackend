
<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::post('/admin/signup', [AdminController::class,'store'])->middleware('IpCheckAndAllow');

Route::post('/admin/login', [AdminController::class,'login'])->middleware('IpCheckAndAllow');

