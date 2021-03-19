<?php

namespace App\Models;

use App\Models\Invoice;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'set_as',
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

    function getUser($email){
        $data=DB::table('users')->where('email',$email)->get();
        return $data;

    }

    public function billing()
    {
        return $this->hasMany(Billing::class);
    }


    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }


    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}
