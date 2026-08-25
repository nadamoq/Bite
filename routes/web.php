<?php

use App\Http\Controllers\front\AddonController;
use App\Http\Controllers\Front\CraveHomeController;
use App\Http\Controllers\Front\MenuItemController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;


Route::get('/', [CraveHomeController::class, 'index'])->name('food.home');
Route::get('home',HomeController::class);
Route::get('menuitem',[MenuItemController::class,'index'])->name('menuitem.index');
Route::get('addon',[AddonController::class,'index'])->name('addon.index');
Route::post('order',[OrderController::class,'store'])->name('order.store');