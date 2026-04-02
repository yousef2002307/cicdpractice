<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Services\InvoiceEmailService;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Send an email for a specific invoice.
     *
     * @param Invoice $invoice
     * @param InvoiceEmailService $service
     * @return string
     */
    public function sendEmail(Invoice $invoice, InvoiceEmailService $service)
    {
        $service->send($invoice);

        return "Email sent for Invoice #{$invoice->invoice_number}";
    }
}
