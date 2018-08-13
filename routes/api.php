<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Buyer;
use App\Http\Controllers\Seller;
use App\Http\Controllers\Product;
use App\Http\Controllers\Categories;
use App\Http\Controllers\Transactions;
use App\Http\Controllers\User;
 /*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/**
 * The Buyer Routes
 */
Route::Resource('buyer','Buyer\BuyerController',['only'=>['index','show']]);
Route::Resource('buyer.transactions','Buyer\BuyerTransactionController',['only'=>['index']]);
Route::Resource('buyer.products','Buyer\BuyerProductController',['only'=>['index']]);
Route::Resource('buyer.sellers','Buyer\BuyerSellerController',['only'=>['index']]);
Route::Resource('buyer.categories','Buyer\BuyerCategoryController',['only'=>['index']]);

/**
 * The Seller Routes
 */
Route::Resource('seller','Seller\SellerController',['only'=>['index','show']]);
Route::Resource('seller.transactions','Seller\SellerTransactionController',['only'=>['index','show']]);
Route::Resource('seller.products','Seller\SellerProductController');
Route::Resource('seller.buyers','Seller\SellerBuyerController',['only'=>['index','show']]);


/**
 * The Category Routes
 */
Route::Resource('category','Categories\CategoryController',['only'=>['index','show']]);
Route::Resource('category.products','Categories\CategoryProductController',['only'=>['index','show']]);
Route::Resource('category.sellers','Categories\CategorySellerController',['only'=>['index']]);
Route::Resource('category.transactions','Categories\CategoryTransactionController',['only'=>['index']]);
Route::Resource('category.buyers','Categories\CategoryBuyerController',['only'=>['index']]);


/**
 * The Product Routes
 */
Route::Resource('product','Product\ProductController',['only'=>['index','show']]);
Route::Resource('product.categories','Product\ProductCategoryController',['only'=>['index']]);
Route::Resource('product.seller','Product\ProductSellerController',['only'=>['index']]);
Route::Resource('product.buyers','Product\ProductBuyerController',['only'=>['index']]);
Route::Resource('product.transactions','Product\ProductTransactionController',['only'=>['index']]);



/**
 * The Product Routes
 */
Route::Resource('transaction','Transactions\TransactionController',['only'=>['index','show']]);
Route::Resource('transaction.categories','Transactions\TransactionCategoryController',['only'=>['index']]);



/**
 * The Product Routes
 */
Route::Resource('user','User\UserController',['except'=>['create','edit']]);







