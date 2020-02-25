<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\userRegistered;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'email','phone', 'password','created_at','updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function verifyUser()
    {
        return $this->hasOne('App\Models\VerifyUser');
    }

    public function wallet()
    {
        return $this->hasOne('App\Models\Wallet');
    }

    // public function format()
    // {
    //     return [
    //       'user_id'=> $this->id,
    //       'user_fname'=> $this->fname,
    //       'user_lname'=> $this->lname,
    //       'phone'=> $this->phone,
    //       'state'=> $this->state,
    //       'address'=> $  
    //     ];
    // }

    public static function boot()
    {
        parent::boot();

        static::created(function($model){
             $user = User::where('role', 'admin')->first();
             $user->notify(new userRegistered($model));

            //Notification::send($admin, new userRegistered($model));


        });
    }
}
