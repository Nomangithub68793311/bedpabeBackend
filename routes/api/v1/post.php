
<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::post('/post/add/free/{id}', [PostController::class,'storeFree'])->middleware('jwt.postmiddleware');
Route::post('/post/add/ad/{id}', [PostController::class,'storeAd'])->middleware('jwt.postmiddleware');
Route::post('/post/add/multiple/{id}', [PostController::class,'storeMultiple'])->middleware('jwt.postmiddleware');
Route::post('/post/add/delete/{id}', [PostController::class,'delete'])->middleware('jwt.postmiddleware');
Route::post('/post/add/update/{id}', [PostController::class,'update'])->middleware('jwt.postmiddleware');
Route::post('/post/add/renew/{id}', [PostController::class,'renew'])->middleware('jwt.postmiddleware');



Route::get('/posts/get/{id}', [PostController::class,'allData'])->middleware('jwt.postmiddleware');


 