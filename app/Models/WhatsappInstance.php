<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappInstance extends Model
{
    use HasFactory;
     protected $table = 'whatsapp_intances';
     protected $fillable = ['qrcode_status',
     'start_value','end_value',
     'instance_id','user_id',
     'phone_number','is_busy',
     'instance_token','instance_expiry',
     'queue_status','updated_at'];

    }