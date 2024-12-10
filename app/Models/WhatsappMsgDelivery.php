<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappMsgDelivery extends Model
{
    use HasFactory;
    protected $table = 'whatsapp_msg_deliveries';
    protected $fillable = ['file_id','user_id','number','msg_response_id','status','message'];

      

}