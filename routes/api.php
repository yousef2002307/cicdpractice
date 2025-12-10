<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Spatie\WebhookClient\Http\Controllers\WebhookController;

Route::post('webhooks/github', WebhookController::class)
    ->name('webhooks.github')
    ->middleware('webhook:github'); 

    
