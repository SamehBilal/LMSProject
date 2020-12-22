<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'user_id', 'position', 'address','major','university','graduation_year','date_of_birth','cv','salary'
    ];
    public function user()
    {
        return $this->hasOne(User::class);
    }
    public static function rules($update = false, $id = null)
    {
        $common = [
            'position'          => "required",
            'address'           => 'required',
            'major'             => "required",
            'university'        => "required",
            'graduation_year'   => "required|date_format:Y-m-d|before:today",
            'date_of_birth'     => "nullable|date_format:Y-m-d|before:today",
            'cv'                => "nullable|max:10000|mimes:doc,docx,pdf",
            'salary'            => "required|numeric",

        ];

        if ($update) {
            return $common;
        }

        return array_merge($common, [
            'cv'                => "required|max:10000|mimes:doc,docx,pdf",
        ]);
    }

}
