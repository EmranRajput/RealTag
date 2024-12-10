<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelFileDetail extends Model
{
    use HasFactory;
    protected $table ='excelFileDetails';
    protected $fillable = ['id','file_name','status','count','file_name','user_id'];
    
    public function whatsAppMsgsSent()
    {
        return $this->hasMany(WhatsappMsgDelivery::class,'file_id','id')->where('status',1);
    }

    public function whatsAppMsgsFailed()
    {
        return $this->hasMany(WhatsappMsgDelivery::class,'file_id','id')->where('status',2);
    }

    public function whatsAppMsgsAll()
    {
        return $this->hasMany(WhatsappMsgDelivery::class,'file_id','id');
    }
    public function whatsAppMsgsPending()
    {
        return $this->hasMany(WhatsappMsgDelivery::class,'file_id','id')->where('status',0);
    }

}