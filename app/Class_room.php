<?php

namespace App;

use App\Activity;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;

class Class_room extends Model
{
    use  RecordsActivity;
    protected $fillable = [
        'name', 'code','school_name', 'status','stage_id','by_id'
    ];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }

    public static function rules($update = false, $id = null)
    {
        $common = [
            'name'          => "required",
            'code'          => "required",
            'school_name'   => Rule::in(['national','international']),
            'status'        => Rule::in(['active','inactive']),
            'stage_id'     => "required",
        ];

        if ($update) {
            return $common;
        }

        return array_merge($common, [

        ]);
    }
}