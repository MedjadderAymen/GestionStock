<?php

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

Route::middleware(['basicAuth'])->group(function () {


    Route::get('inv', function () {

        $employers = \App\employer::doesntHave('inStockProducts')->with('user')->get();

        return view('who')->with('employers', $employers);

    });

    Route::get('csrf', function () {
        return csrf_token();
    });

    Route::get('/', 'HomeController@index')->name('home');

    Auth::routes(['register' => false]);

    Route::get('/home', 'HomeController@index')->name('home');

    Route::middleware(['auth'])->group(function () {

        Route::resource('employer', "EmployerController");

        Route::resource('user', "UserController");
        Route::get('user/{user}/print', "UserController@print")->name('user.print');
        Route::get('user/{user}/restore', "UserController@restore")->name('user.restore');
        Route::post('user/search', "UserController@search")->name('user.search');

        Route::resource('printer', "PrinterController");
        Route::get('/printer/showRedirect/{printer}', "PrinterController@showRedirect")->name('printer.showRedirect');
        Route::get('/printer/showUpdate/{printer}', "PrinterController@showUpdate")->name('printer.showUpdate');
        Route::put('/printer/updateData/{printer}', "PrinterController@updateData")->name('printer.updateData');

        Route::resource('stock', "InStockProductController");
        Route::post('stock/search', "InStockProductController@search")->name('stock.search');
        Route::get('stock/{stock}/restore', "InStockProductController@restore")->name('stock.restore');
        Route::get('stock/qrCode/{stockProduct}', "InStockProductController@QrCode")->name('stock.qrcode');

        Route::resource('toner', "TonerController");

        Route::resource('consumableToner', "ConsumableTonerController");

        Route::resource('invoice', "InvoiceController");

        Route::resource('site', 'SiteController');

        Route::resource('location', 'LocationController');

    });

});

Route::get('export_mapping', 'ExcelController@export_mapping')->name('registrations.export_mapping');

