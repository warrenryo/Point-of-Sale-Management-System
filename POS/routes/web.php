<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosController;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TransactionController;


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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//USER TAB
Route::get('/user-list', [UserController::class, 'index'])->name('user');
Route::delete('/delete-user', [UserController::class, 'deleteUser']);

//EMPLOYEE TAB
Route::get('/add-employee', [EmployeeController::class, 'index'])->name('add_employee');//SHOW ADD EMPLOYEE TAB
Route::get('/list-employee', [EmployeeController::class, 'listEmployees'])->name('list_employees');//SHOW ALL LIST EMPLOYEE
Route::post('/put-employee', [EmployeeController::class, 'store']);//ADD EMPLOYEE
Route::get('/edit-employee/{id}', [EmployeeController::class, 'update']);//EDIT EMPLOYEE
Route::delete('/delete-employee', [EmployeeController::class, 'destroy']);//DELETE EMPLOYEE
Route::get('/view-employee/{id}', [EmployeeController::class, 'viewEmployee']);//VIEW EMPLOYEE
Route::post('/update-employee/{id}', [EmployeeController::class, 'updateEmployee']);

//PRODUCT TAB
Route::get('/add-product', [ProductsController::class, 'index'])->name('add_products');//ADD PRODUCT TAB SHOW
Route::post('/add-product', [ProductsController::class, 'store']);//ADD PRODUCT
Route::get('/brands', [ProductsController::class, 'brandIndex'])->name('brands');//SHOW BRAND TAB
Route::post('/add-brand', [ProductsController::class, 'addBrand']);//ADD BRAND
Route::put('/edit-brand', [ProductsController::class, 'editBrand']);//EDIT BRAND
Route::delete('/delete-brand',[ProductsController::class, 'deleteBrand']);//DELETE BRAND
Route::get('/list-of-products', [ProductsController::class, 'listOfProducts'])->name('list_product');//SHOW LIST PRODUCT TAB
Route::get('/edit-product/{id}', [ProductsController::class, 'editProduct']);//EDIT PRODUCT
Route::delete('/delete-product', [ProductsController::class, 'deleteProduct']);//DELETE PRODUCT
Route::post('/update-product/{id}', [ProductsController::class, 'updateProduct']);//UPDATE A PRODUCT


//CUSTOMER TAB
Route::get('/customer', [CustomerController::class, 'index'])->name('add_customer');
Route::post('/add-customer', [CustomerController::class, 'store']);
Route::get('/list-customer', [CustomerController::class, 'customerList'])->name('list_customer');


//POS TAB
Route::get('/pos', [PosController::class, 'index'])->name('pos');

//CART TAB
Route::post('/add-cart', [CartController::class, 'index']);
Route::post('/update-cart/{rowId}', [CartController::class, 'updateCart']);
Route::get('/delete-cart/{rowId}', [CartController::class, 'deleteCart']);
Route::get('/delete-all', [CartController::class, 'deleteAll']);
Route::post('/create-invoice', [CartController::class, 'createInvoice']);
Route::post('/add-transaction', [CartController::class, 'addTransaction']); 

//TRANSACTION TAB
Route::get('/transaction-history', [TransactionController::class, 'index'])->name('transaction');
Route::get('/view-receipt/{id}', [TransactionController::class, 'viewReceipt']);

//ABOUT TAB
Route::get('/about', [HomeController::class, 'viewAbout'])->name('about');