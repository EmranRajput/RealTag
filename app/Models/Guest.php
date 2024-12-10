<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;
    protected $table = 'guests';

     protected $fillable = [
        'tenant_name',
        'landlord_name',
        'landlord_ic_no',
        'tenant_ic_no',    
    ];
}