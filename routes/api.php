<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/products',[\App\Http\Controllers\ProductController::class,'index'])->name('api.products');
