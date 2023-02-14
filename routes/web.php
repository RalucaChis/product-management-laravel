<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CategoryController;
use \App\Http\Controllers\ValueController;
use \App\Http\Controllers\TagController;
use \App\Http\Controllers\BrandController;
use \App\Http\Controllers\OptionController;
use \App\Http\Controllers\VariantController;
use \App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/brands', function () {
        return view('views_brand/get_all_brands');
    })->name('get_all_brands');

    Route::get('/brand',[BrandController::class, 'add']);
    Route::post('/brand',[BrandController::class, 'create']);

    Route::get('/brand/{brand}', [BrandController::class, 'edit']);
    Route::post('/brand/{brand}', [BrandController::class, 'update']);

    Route::get('/categories', function () {
        return view('views_category/get_all_categories');
    })->name('get_all_categories');

    Route::get('/category',[CategoryController::class, 'add']);
    Route::post('/category',[CategoryController::class, 'create']);

    Route::get('/category/{category}', [CategoryController::class, 'edit']);
    Route::post('/category/{category}', [CategoryController::class, 'update']);

    Route::get('/colors', function () {
        return view('views_color/get_all_colors');
    })->name('get_all_colors');

    Route::get('/color',[ColorController::class, 'add']);
    Route::post('/color',[ColorController::class, 'create']);

    Route::get('/color/{color}', [ColorController::class, 'edit']);
    Route::post('/color/{color}', [ColorController::class, 'update']);

    Route::get('/options', function () {
        return view('views_option/get_all_options');
    })->name('get_all_options');

    Route::get('/option',[OptionController::class, 'add']);
    Route::post('/option',[OptionController::class, 'create']);

    Route::get('/option/{option}', [OptionController::class, 'edit']);
    Route::post('/option/{option}', [OptionController::class, 'update']);

    Route::get('/products', function () {
        return view('views_product/get_all_products');
    })->name('get_all_products');

    Route::get('/product',[ProductController::class, 'add']);
    Route::post('/product',[ProductController::class, 'create']);

    Route::get('/product/{product}', [ProductController::class, 'edit']);
    Route::post('/product/{product}', [ProductController::class, 'update']);

    Route::get('/tags', function () {
        return view('views_tag/get_all_tags');
    })->name('get_all_tags');

    Route::get('/tag',[TagController::class, 'add']);
    Route::post('/tag',[TagController::class, 'create']);

    Route::get('/tag/{tag}', [TagController::class, 'edit']);
    Route::post('/tag/{tag}', [TagController::class, 'update']);


    Route::get('/values', function () {
        return view('views_value/get_all_values');
    })->name('get_all_values');

    Route::get('/value',[ValueController::class, 'add']);
    Route::post('/value',[ValueController::class, 'create']);

    Route::get('/value/{value}', [ValueController::class, 'edit']);
    Route::post('/value/{value}', [ValueController::class, 'update']);

//    Route::get('/variants', function () {
//        return view('views_variant/get_all_variants');
//    })->name('get_all_variants');
//
//    Route::get('/variant',[VariantController::class, 'add']);
//    Route::post('/variant',[VariantController::class, 'create']);
//
//    Route::get('/variant/{variant}', [VariantController::class, 'edit']);
//    Route::post('/variant/{variant}', [VariantController::class, 'update']);
});
