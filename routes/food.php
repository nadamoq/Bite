<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Crave Kitchen — Food Platform Route
|--------------------------------------------------------------------------
|
| Register this in your Laravel routes/web.php or include this file.
|
*/

Route::view('/', 'food.crave')->name('food.home');
