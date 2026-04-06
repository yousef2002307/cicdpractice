<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Services\InvoiceEmailService;
use Illuminate\Http\Request;
use App\DTOs\InvoiceEmailDto;

class InvoiceController extends Controller
{
    /**
     * Send an email for a specific invoice.
     *
     * @param Invoice $invoice
     * @param InvoiceEmailService $service
     * @return string
     */
    public function sendEmail($id, InvoiceEmailService $service)
    {
        $invoice = Invoice::find($id)->load('user');
        
        // dd($invoice);
        $dto = InvoiceEmailDto::fromInvoice($invoice);
        // dd($dto);
        $service->send($dto);

        return "Email sent for Invoice #{$invoice->invoice_number}";
    }

    /**
     * Display the specified invoice.
     *
     * @param Invoice $invoice
     * @return \Illuminate\View\View
     */
    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }
}
