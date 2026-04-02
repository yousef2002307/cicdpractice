<x-mail::message>
# Invoice Alert: {{ $invoice->invoice_number }}

Dear **{{ $invoice->user->name }}**,

We have generated a new invoice for you. Please find the details below:

<x-mail::panel>
### Summary
- **Invoice #:** {{ $invoice->invoice_number }}
- **Amount:** ${{ number_format($invoice->amount, 2) }}
- **Status:** {{ ucfirst($invoice->status) }}
- **Issue Date:** {{ $invoice->invoice_date }}
- **Due Date:** {{ $invoice->due_date }}
</x-mail::panel>

@if($invoice->notes)
> **Note:** {{ $invoice->notes }}
@endif

<x-mail::button :url="config('app.url') . '/invoices/' . $invoice->id" color="primary">
View Detailed Invoice
</x-mail::button>

If you have any questions, feel free to reply to this email.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
