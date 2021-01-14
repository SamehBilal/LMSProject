<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'user_id', 'attendance','date', 'class_id','notes'
    ];

    public function class()
    {
        return $this->belongsTo(Class_room::class , "id" , "class_id");
    }

    public function student()
    {
        return $this->belongsTo(Student::class , "student_id" , "id");
    }
}
