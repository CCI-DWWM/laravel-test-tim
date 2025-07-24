<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Route d'accueil qui redirige vers les produits
Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::resource('products', ProductController::class);
