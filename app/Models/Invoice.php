<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /** @use HasFactory<\Database\Factories\InvoiceFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'invoice_number',
        'amount',
        'status',
        'invoice_date',
        'due_date',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
