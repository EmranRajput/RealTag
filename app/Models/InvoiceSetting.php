<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceSetting extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'invoice_settings';

    // The attributes that are mass assignable.
    protected $fillable = [
        'company_name',
        'logo',
        'agent_id',
        'company_address',
        'company_fax',
        'contact',
        'sst_id',
        'service_tax',
        'description',
    ];

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    /**
     * Create a new InvoiceSetting instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // You can customize the initialization logic here if needed.
    }
}

