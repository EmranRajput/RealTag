<?php

namespace App\Models;
// use App\Models\birthdayEmailReminder;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Helpers\FileHelper;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use \App\Traits\TraitModel;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'profile_photo',
        'role',
        'birth_date',
        'status',
        'password',
        'gender',
        'address',
        'identity_number',
        'is_active',
        'birthday_reminder_toggle',
        'agent_id','is_guest'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $attributes = [
        'status' => 1,
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
        });

        static::updating(function ($item) {
        });

        static::deleting(function ($item) {
            // if ($val = $item->getImage()) fileDelete(self::folderName(), $val);
        });
    }
    const ROLE_ADMIN               = 1;
    const ROLE_AGENT               = 2;
    const ROLE_LANDLORD            = 3;
    const ROLE_TENENT              = 4;

    const TITLE_MR = 1;
    const TITLE_MRS = 2;
    const TITLE_MISS = 3;
    const TITLE_MS = 4;
    const TITLE_DR = 5;
    const TITLE_RN = 6;
    const TITLE_PROF = 7;


    const BASE_ROUTE = 'user.';
    const FOLDER = 'general';


    public static function roles()
    {
        return [
            // Admin Login Screen
            1 => 'Admin',
            2 => 'Agent',
            3 => 'Land Lord',
            4 => 'Tenent'
        ];
    }

    public static function titleType()
    {
        return [
            self::TITLE_MR => 'MR',
            self::TITLE_MRS => 'MRS',
            self::TITLE_MISS => 'MISS',
            self::TITLE_MS => 'MS',
            self::TITLE_DR => 'DR',
            self::TITLE_RN => 'RN',
            self::TITLE_PROF => 'PROF',
        ];
    }
    public function isAdmin()
    {
        return $this->getRole() == self::ROLE_ADMIN;
    }
    public function isAgent()
    {
        return $this->getRole() == self::ROLE_AGENT;
    }
    public function isLandLord()
    {
        return $this->getRole() == self::ROLE_LANDLORD;
    }
    public function isTenent()
    {
        return $this->getRole() == self::ROLE_TENENT;
    }
    public function getRole(){
        return $this->role;
    }
    public function printRole(){
        $roles = self::roles();
        return isset($roles[$this->role]) ?$roles[$this->role]: '';
    }
    public function getPicture($url = 0)
    {
        return $url ? FileHelper::url($this->profile_photo, self::folderName('profile')) : $this->profile_photo;
    }
    public function getProfilepic($url = 0)
    {
        $image =  $url ? FileHelper::url($this->profile_photo, self::folderName('profile')) : $this->profile_photo;
        return url($image)  ? :"https://ui-avatars.com/api/?name=".$this->name."&size=200";
    }
    // public function birthdayEmailReminder(): HasOne
    // {
    //     return $this->hasOne(birthdayEmailReminder::class, 'user_id', 'id');
    // }
}