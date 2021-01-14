<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use  RecordsActivity;
    protected $fillable = [
        'user_id', 'position', 'address','major','university','graduation_year','cv','salary'
    ];
    public function user()
    {
        return $this->hasOne(User::class  , "id" , "user_id");
    }
    public static function rules($update = false, $id = null)
    {
        $common = [
            'position'          => "required",
            'major'             => "required",
            'university'        => "required",
            'graduation_year'   => "required|date_format:Y-m-d|before:today",
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
