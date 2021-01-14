<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;

class Class_room extends Model
{
    use  RecordsActivity;
    protected $fillable = [
        'name', 'code','school_name', 'status','stage_id'
    ];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }

    public function sessions()
    {
        return $this->hasMany(Session::class , "class_id" , "id");
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