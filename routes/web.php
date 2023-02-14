<?php

use App\Http\Controllers\DashboardController;
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

Route::get('/', function () {
    return view('login');
});
Route::get('/login', [DashboardController::class, 'login']);
Route::post('/login', [DashboardController::class, 'auth'])->name('login');

Route::middleware(['mstauth'])->group(function () {
    // Routes that require the 'User' middleware

    Route::get('logout', [DashboardController::class, 'logout'])->name('logout');

    Route::get('dashboard', [DashboardController::class, 'index']);
    
    Route::get('/dashboard', [DashboardController::class, 'transactionpage'])->name('dashboardpage');

//----------- transection data ---------------------///
    Route::get('/transactions', [DashboardController::class, 'transactionpage'])->name('transactionpage');
    Route::get('dashboard/{id}/transectiongetdata', [DashboardController::class, 'gettransections']);
    Route::put('/dashboard', [DashboardController::class, 'updatetransections'])->name('update.transections');
    Route::delete('dashboard/transectiondestroy/{id}', [DashboardController::class, 'transectiondestroy'])->name('transectiondestroy');

//----------- withdraw Request ---------------------///
    Route::get('/Withdraw-request', [DashboardController::class, 'WithdrawPage'])->name('withdrawpage');
    Route::get('dashboard/getwithdraw/{id}', [DashboardController::class, 'getwithdraw']);
    Route::delete('dashboard/withdrawdestroy/{id}', [DashboardController::class, 'withdrawdestroy'])->name('withdrawdestroy');
    Route::post('dashboard/updatewithdraw/{withdrawRequestId}', [DashboardController::class, 'updateWithdraw']);

    ///---------------- BuyStock -------------------//
    Route::delete('dashboard/buystock/{buyStockId}', [DashboardController::class, 'buystockdestroy'])->name('buystock.destroy');
    Route::get('/buystock', [DashboardController::class, 'BuyStock'])->name('buystock');

    ///-------------- Company ----------------//
    Route::delete('dashboard/deletecompany/{companyId}', [DashboardController::class, 'companydestroy'])->name('company.destroy');
    Route::post('addcomapny_store', [DashboardController::class, 'storecompany'])->name('addcomapny.store');
    Route::get('/company', [DashboardController::class, 'CompaniesPage'])->name('companypage');
    

    ///------- Manage User ------------------//
    Route::get('/Manage-User', [DashboardController::class, 'manageuserpage'])->name('manageuserpage');

});
