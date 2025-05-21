<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;

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

Route::controller(ContactController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'index')->name('contact.index');
    Route::post('/confirm', 'confirm')->name('contact.confirm');
    Route::post('/thanks', 'submit')->name('contact.thanks');
});
Route::middleware('auth')->group(function() {
    Route::get('/admin', [AdminController::class, 'admin']);
});
