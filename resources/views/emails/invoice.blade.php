<x-mail::message>
# Invoice Alert: {{ $dto->invoiceNumber }}

Dear **{{ $dto->userName }}**,

We have generated a new invoice for you. Please find the details below:

<x-mail::panel>
### Summary
- **Invoice #:** {{ $dto->invoiceNumber }}
- **Amount:** ${{ number_format($dto->total, 2) }}
- **Status:** {{ ucfirst($dto->status) }}
- **Issue Date:** {{ $dto->invoiceDate }}
- **Due Date:** {{ $dto->dueDate }}
</x-mail::panel>

@if($dto->notes)
> **Note:** {{ $dto->notes }}
@endif

<x-mail::button :url="config('app.url') . '/invoices/' . $dto->id" color="primary">
View Detailed Invoice
</x-mail::button>

If you have any questions, feel free to reply to this email.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
