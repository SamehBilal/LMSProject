<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use  RecordsActivity;
    protected $fillable = [
        'class_id', 'course_id', 'day', 'session_time_id'
    ];

    public function course()
    {
        return $this->hasOne(Course::class);
    }

    public function class()
    {
        return $this->belongsTo(Class_room::class);
    }

    public function sessionTime()
    {
        return $this->belongsTo(SessionTime::class);
    }
}
