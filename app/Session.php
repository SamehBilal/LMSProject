<?php

namespace App;

use App\Activity;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use  RecordsActivity;
    protected $fillable = [
        'class_id', 'course_id', 'start','end'
    ];

    public function course()
    {
        return $this->hasOne(Course::class);
    }

    public function class()
    {
        return $this->belongsTo(Class_room::class);
    }
}
