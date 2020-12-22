<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'email', 'password','username','firstname','lastname','other_email','phone','gender','avatar'
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

    public function staff()
    {
        return $this->hasOne(Staff::class);
    }

    public static function rules($update = false, $id = null)
    {
        $common = [
            'fullname'      => "required|max:40",  
            'email'         => "required|email|unique:users,email,$id|unique:users,email,$id",
            'password'      => 'nullable|confirmed',
            'username'      => "required|unique:users,username,$id",
            'firstname'     => "required|min:3|max:20",
            'lastname'      => "required|min:3|max:20",
            'other_email'   => "nullable|email|unique:users,email,$id|unique:users,other_email,$id",
            'phone'         => "nullable|numeric",
            'gender'        => "nullable",

        ];

        if ($update) {
            return $common;
        }

        return array_merge($common, [
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);
    }
}
