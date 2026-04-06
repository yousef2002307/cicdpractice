<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $invoice->invoice_number }} - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen py-12 px-4">

    <div class="max-w-4xl mx-auto">
        <!-- Back link -->
        <div class="mb-8">
            <a href="/" class="text-indigo-600 hover:text-indigo-800 flex items-center gap-2 font-medium transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                Back to Dashboard
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-slate-200">
            <!-- Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-violet-700 p-8 text-white flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight uppercase">Invoice</h1>
                    <p class="text-indigo-100 mt-1 opacity-80">Official Document from {{ config('app.name') }}</p>
                </div>
                <div class="text-right">
                    <p class="text-indigo-500 bg-white/10 px-4 py-2 rounded-lg inline-block font-semibold">
                        # {{ $invoice->invoice_number }}
                    </p>
                </div>
            </div>

            <!-- Content Area -->
            <div class="p-8 md:p-12">
                
                <!-- Status Badge -->
                <div class="mb-10 text-right">
                    <span class="px-4 py-2 rounded-full text-sm font-bold uppercase tracking-wider 
                        {{ $invoice->status === 'paid' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                        {{ $invoice->status }}
                    </span>
                </div>

                <!-- Info Grid -->
                <div class="grid md:grid-cols-2 gap-12 mb-16">
                    <div>
                        <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-4">Billed To</h3>
                        <p class="text-xl font-bold text-slate-800">{{ $invoice->user->name }}</p>
                        <p class="text-slate-500">{{ $invoice->user->email }}</p>
                    </div>
                    <div class="md:text-right">
                        <div class="mb-6">
                            <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-2">Issue Date</h3>
                            <p class="text-lg font-semibold text-slate-700">{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-2">Due Date</h3>
                            <p class="text-lg font-semibold text-rose-500">{{ \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Items Table -->
                <div class="border rounded-xl overflow-hidden mb-12">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-4 font-bold text-slate-600">Description</th>
                                <th class="px-6 py-4 font-bold text-slate-600 text-right">Amount</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            <tr>
                                <td class="px-6 py-8">
                                    <p class="text-slate-800 font-semibold mb-1">Professional Services</p>
                                    <p class="text-sm text-slate-500 italic">Billable for services under invoice #{{ $invoice->invoice_number }}</p>
                                </td>
                                <td class="px-6 py-8 text-right text-xl font-bold text-slate-800">
                                    ${{ number_format($invoice->amount, 2) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Notes -->
                @if($invoice->notes)
                <div class="bg-indigo-50/50 p-6 rounded-xl border border-indigo-100 mb-12">
                    <h3 class="text-sm font-bold text-indigo-900 uppercase tracking-widest mb-2">Important Notes</h3>
                    <p class="text-indigo-800 italic leading-relaxed">
                        {{ $invoice->notes }}
                    </p>
                </div>
                @endif

                <!-- Total Summary -->
                <div class="flex flex-col items-end gap-3 pt-8 border-t">
                    <div class="flex gap-12 text-slate-500">
                        <span>Subtotal:</span>
                        <span>${{ number_format($invoice->amount, 2) }}</span>
                    </div>
                    <div class="flex gap-12 text-slate-500">
                        <span>Tax (0%):</span>
                        <span>$0.00</span>
                    </div>
                    <div class="flex gap-12 text-3xl font-bold text-slate-900 pt-3">
                        <span>Total:</span>
                        <span class="text-indigo-600">${{ number_format($invoice->amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Footer Action -->
            <div class="bg-slate-50 p-8 border-t text-center">
                <button onclick="window.print()" class="bg-white border-2 border-slate-200 text-slate-700 font-bold px-8 py-3 rounded-xl hover:bg-slate-100 transition-all flex items-center justify-center gap-2 mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9V2h12v7"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect width="12" height="8" x="6" y="14"/></svg>
                    Print or Save as PDF
                </button>
            </div>
        </div>

        <p class="mt-8 text-center text-slate-400 text-sm">
            Thank you for being a valued customer. If you have any questions, please contact our support team.
        </p>
    </div>

</body>
</html>
