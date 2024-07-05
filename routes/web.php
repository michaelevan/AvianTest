<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TestController::class, 'index']);

Route::post('/history/insert', [TestController::class, 'insertHistory'])->name('history.insert');
Route::put('/history/update/{id}', [TestController::class, 'updateHistory'])->name('history.update');
Route::delete('/history/delete/{id}', [TestController::class, 'deleteHistory'])->name('history.delete');
Route::get('/export-history-excel', [TestController::class, 'exportHistoryExcel'])->name('export.history.excel');
Route::get('/export-history-pdf', [TestController::class, 'exportHistoryPdf'])->name('export.history.pdf');
Route::post('/import-history', [TestController::class, 'importHistory'])->name('import.history');

Route::post('/penjualan/insert', [TestController::class, 'insertPenjualan'])->name('penjualan.insert');
Route::put('/penjualan/update/{id}', [TestController::class, 'updatePenjualan'])->name('penjualan.update');
Route::delete('/penjualan/delete/{id}', [TestController::class, 'deletePenjualan'])->name('penjualan.delete');
Route::get('/export-penjualan-excel', [TestController::class, 'exportPenjualanExcel'])->name('export.penjualan.excel');
Route::get('/export-penjualan-pdf', [TestController::class, 'exportPenjualanPdf'])->name('export.penjualan.pdf');
Route::post('/import-penjualan', [TestController::class, 'importPenjualan'])->name('import.penjualan');

Route::post('/areaSales/insert', [TestController::class, 'insertAreaSales'])->name('areaSales.insert');
Route::put('/areaSales/update/{id}', [TestController::class, 'updateAreaSales'])->name('areaSales.update');
Route::delete('/areaSales/delete/{id}', [TestController::class, 'deleteAreaSales'])->name('areaSales.delete');
Route::get('/export-areaSales-excel', [TestController::class, 'exportAreaSalesExcel'])->name('export.areaSales.excel');
Route::get('/export-areaSales-pdf', [TestController::class, 'exportAreaSalesPdf'])->name('export.areaSales.pdf');
Route::post('/import-areaSales', [TestController::class, 'importAreaSales'])->name('import.areaSales');

Route::post('/masterSales/insert', [TestController::class, 'insertMasterSales'])->name('masterSales.insert');
Route::put('/masterSales/update/{id}', [TestController::class, 'updateMasterSales'])->name('masterSales.update');
Route::delete('/masterSales/delete/{id}', [TestController::class, 'deleteMasterSales'])->name('masterSales.delete');
Route::get('/export-masterSales-excel', [TestController::class, 'exportMasterSalesExcel'])->name('export.masterSales.excel');
Route::get('/export-masterSales-pdf', [TestController::class, 'exportMasterSalesPdf'])->name('export.masterSales.pdf');
Route::post('/import-masterSales', [TestController::class, 'importMasterSales'])->name('import.masterSales');
