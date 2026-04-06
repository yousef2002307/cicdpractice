<?php

namespace App\DTOs;
use App\Models\Invoice;
readonly class InvoiceEmailDto
{
    public function __construct(
        public string $userEmail,
        public string $invoiceNumber,
        public string $userName,
        public float $total,
        public string $status,
        public string $invoiceDate,
        public string $dueDate,
        public ?string $notes = null,
        public ?string $id = null
    ) {}

    public static function fromInvoice(Invoice $invoice): self
    {
        return new self(
            $invoice->user->email,
            $invoice->invoice_number,
            $invoice->user->name,
            $invoice->amount,
            $invoice->status,
            $invoice->invoice_date,
            $invoice->due_date,
            $invoice->notes,
            $invoice->id
        );
    }
}