<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    use HasFactory;
    protected $table = 'invoices';
    protected $fillable = [
        'agent_id',
        'r_agreement_id',
        'name',
        'identity_number',
        'invoice_number',
        'item_list',
        'sub_total',
        'service_tax',
        'total',
        'invoice_type',
        'status'   ,'created_by_cron' 
    ];
    public static function boot()
{
    parent::boot();

    static::creating(function ($invoice) {
        if (!$invoice->invoice_number) {
            $invoice->invoice_number = static::generateInvoiceNumber();
        }
        
    });
}

private static function generateInvoiceNumber()
{
    $prefix = 'INV'; // You can customize the prefix
    $date = now()->format('Ymd');
    $lastInvoice = static::latest()->first();

    if ($lastInvoice) {
        $lastNumber = substr($lastInvoice->invoice_number, -4);
        $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
    } else {
        $newNumber = '0001';
    }

    return $prefix . $date . $newNumber;
}
}