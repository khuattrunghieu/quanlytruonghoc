<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Account;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Modules\Classes\Entities\Classes;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'phone',
        'address',
        'birthday',
        'account_id',
        'otp',
        'authenticate'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
    public function roles()
    {
        return $this->hasMany(Role::class);
    }
    public function checkRole($category_id, $role)
    {
        $roles = $this->roles()->where('category_id', $category_id)->first();
        if ($roles && $roles->$role == 1) {
            return true;
        }
        return false;
    }
}
