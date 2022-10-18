
<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/p_route', function () {
    return ('public....');
});
Route::get('/r_route', function () {
    return ('restricted....');
});
Route::get('/p_r_route', function () {
    return ('partially protected....');
});
