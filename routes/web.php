<?php

use App\Http\Controllers\InStockProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('csrf', function () {
    return csrf_token();
});

Route::get('/', 'HomeController@index')->name('home');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'helpDesk'])->group(function () {

    Route::resource('employer', "EmployerController");
    Route::resource('user', "UserController");
    Route::resource('printer', "PrinterController");
    Route::get('/printer/showRedirect/{printer}', "PrinterController@showRedirect")->name('printer.showRedirect');
    Route::resource('stock', "InStockProductController");
    Route::resource('toner', "TonerController");
    Route::resource('consumableToner', "ConsumableTonerController");
    Route::resource('invoice', "InvoiceController");

});
