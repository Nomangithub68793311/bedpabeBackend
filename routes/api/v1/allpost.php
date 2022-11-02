
<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicAllData;





Route::get('/post/get/{city}/{category}', [PublicAllData::class,'allPost'])->middleware('IpCheckAndAllow');
Route::get('/post/get/single/{id}', [PublicAllData::class,'singlePost'])->middleware('IpCheckAndAllow');

