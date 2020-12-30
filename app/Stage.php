<?php

namespace App;

use App\Activity;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use  RecordsActivity;
    protected $fillable = [
        'name', 'school_name', 'fees'
    ];

    public static function rules($update = false, $id = null)
    {
        $common = [
            'name'        => "required",
            'school_name'      => Rule::in(['national','international']),
            'fees'      => "required",
        ];

        if ($update) {
            return $common;
        }

        return array_merge($common, [

        ]);
    }
}
