<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalTemplate extends Model
{
    use HasFactory;
    public $table = 'rental_templates';
    protected $fillable = ['description','name','user_id','status','is_default'];
}