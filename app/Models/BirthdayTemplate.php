<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BirthdayTemplate extends Model
{
    use HasFactory;
    public $table = 'birthday_templates';
    protected $fillable = ['description','name','user_id','status','default'];
}