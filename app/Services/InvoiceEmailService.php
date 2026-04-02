<?php

namespace App\Services;

use App\Models\Invoice;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class InvoiceEmailService
{
    /**
     * Send an invoice email to the related user.
     *
     * @param Invoice $invoice
     * @return void
     */
    public function send(Invoice $invoice)
    {
        $user = $invoice->user;

        Mail::to($user->email)->send(new InvoiceMail($invoice));

        Log::info("Email sent to {$user->email} for Invoice #{$invoice->invoice_number} with amount {$invoice->amount}");
    }
}
