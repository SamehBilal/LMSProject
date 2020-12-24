<?php

namespace App;

use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id', 'serial' , 'stage_id', 'class_id','document','status','blood_type'
    ];
    public function user()
    {
        return $this->hasOne(User::class);
    }
    public static function rules($update = false, $id = null)
    {
        $common = [
            'serial'        => "required|unique:students,serial,$id",
            'stage_id'      => 'required',
            'class_id'      => "required",
            'document'      => "nullable|max:10000|mimes:doc,docx,pdf",
            'status'        => Rule::in(['hold','accepted','graduated']),
            'blood_type'    => Rule::in(['A+', 'A-','B+','B-','AB+','AB-','O+','O-']),

        ];

        if ($update) {
            return $common;
        }

        return array_merge($common, [
            'serial'        => 'required|unique:students',
            'document'      => "required|max:10000|mimes:doc,docx,pdf",
        ]);
    }

}
