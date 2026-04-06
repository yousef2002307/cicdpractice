<?php

namespace App\Services;

use App\Models\Invoice;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\DTOs\InvoiceEmailDto;

class InvoiceEmailService
{
    /**
     * Send an invoice email to the related user.
     *
     * @param Invoice $invoice
     * @return void
     */
    public function send(InvoiceEmailDto $dto)
    {
        $user = $dto->userEmail;

        Mail::to($user)->send(new InvoiceMail($dto));

        Log::info("Email sent to {$user} for Invoice #{$dto->id} with amount {$dto->total}");
    }
}
