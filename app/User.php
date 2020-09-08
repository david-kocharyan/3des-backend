<?php

namespace App;

use App\Models\Partner;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    CONST TYPE = array('common' => 1, 'partner' => 2);

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'full_name', 'phone', 'email', 'password', 'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at'
    ];

    public function partner()
    {
        return $this->hasOne(Partner::class, "user_id", "id");
    }

}
