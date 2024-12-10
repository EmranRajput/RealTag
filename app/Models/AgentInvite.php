<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentInvite extends Model
{
    use HasFactory;
    use \App\Traits\TraitModel;
    public $table = 'agent_invite';

    protected $fillable = [
        'email',
        'role',
        'is_register'
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_register' => 'integer',
    ];
}