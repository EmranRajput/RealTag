<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalAgreement extends Model
{
    use HasFactory;
    protected $table = 'rental_agreements';
    protected $fillable = [
        'tenant_id',
        'landlord_id',
        'agent_id',
        'address',
        'start_date',
        'end_date',
        'duration',
        'security_deposit',
        'utility_deposit',
        'agent_service',
        'agreement_id'
    ];


// In RentalAgreement.php

public function user()
{
    return $this->belongsTo(User::class, 'tenant_id');
}

     public function agent()
    {
        return $this->belongsTo(User::class,'agent_id','id');
    }
    
     public function tenant()
    {
        return $this->belongsTo(User::class,'tenant_id','id');
    }
    
    public function landlord()
    {
        return $this->belongsTo(User::class,'landlord_id','id');
    }
}