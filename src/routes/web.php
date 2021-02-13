<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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

// Auth::routes();

// Route::get('/', 'HomeController@home')->name('welcome');

// Route::get('/',[HomeController::class, 'home'])->name('home');


Route::get('/', 'App\Http\Controllers\HomeController@home')->name('home');
Route::get('/dashboard', 'App\Http\Controllers\HomeController@home')->name('dashboard');
Route::get('/getapp', 'App\Http\Controllers\HomeController@getapp')->name('getapp');
Route::get('/help', 'App\Http\Controllers\HomeController@help')->name('help');
Route::get('/services', 'App\Http\Controllers\HomeController@services')->name('services');




// admin routes

Route::get('/group', 'App\Http\Controllers\GroupController@index')->name('group');
Route::get('/permission', 'App\Http\Controllers\PermissionController@index')->name('permission');
Route::get('/user', 'App\Http\Controllers\UserController@index')->name('user');
Route::get('/profile', 'App\Http\Controllers\UserController@profile')->name('profile');

Route::get('/category', 'App\Http\Controllers\CategoryController@index')->name('category');
Route::get('/subcategory', 'App\Http\Controllers\SubCategoryController@index')->name('subcategory');
Route::get('/items', 'App\Http\Controllers\ItemController@index')->name('items');
Route::get('/itemmodels', 'App\Http\Controllers\ItemModelController@index')->name('itemmodels');
Route::get('/availableitemmodels', 'App\Http\Controllers\AvailableItemController@index')->name('availableitemmodels');
Route::get('/itemsizes', 'App\Http\Controllers\SizeController@index')->name('itemsizes');
Route::get('/itemsizedimension', 'App\Http\Controllers\SizeDimensionController@index')->name('itemsizedimension');



Route::get('/orders', 'App\Http\Controllers\OrderController@index')->name('orders');
Route::get('/purchases', 'App\Http\Controllers\PurchaseController@index')->name('purchases');
Route::get('/purchases/{id}/details', 'App\Http\Controllers\PurchaseController@show')->name('purchases.show');

Route::get('/companies', 'App\Http\Controllers\CompanyController@index')->name('companies');
Route::get('/suppliers', 'App\Http\Controllers\SupplierController@index')->name('suppliers');



Route::get('/customer', 'App\Http\Controllers\CustomerController@index')->name('customer');
Route::get('/customertypes', 'App\Http\Controllers\CustomerTypesController@index')->name('customertypes');
Route::get('/customerranking', 'App\Http\Controllers\CustomerRankingController@index')->name('customerranking');