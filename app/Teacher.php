<?php

namespace App;

use App\Activity;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use  RecordsActivity;
    protected $fillable = [
        'user_id', 'course_id','university','graduation_year','cv','salary'
    ];
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function classes()
    {
        return $this->belongsToMany(Class_room::class);
    }
    public static function rules($update = false, $id = null)
    {
        $common = [
            'course_id'         => "required",
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
