<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;

class Tanent extends Model implements Authenticatable
{
    use HasFactory;
    use Notifiable;
    protected $table ='tanents';
    
    protected $fillable = [
        'full_name',
        'email',
        'contact_number',
        'password',
        'identify_number',
        'user_id'  
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

        public function getAuthIdentifierName()
    {
        return 'id'; // Assuming your primary key is 'id'
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password; // Assuming your password field is 'password'
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}