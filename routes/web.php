<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sendemail/{invoice}', [InvoiceController::class, 'sendEmail']);

Route::get('/invoices/{invoice}', [InvoiceController::class, 'show']);
