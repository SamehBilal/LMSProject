<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use  RecordsActivity;
    protected $fillable = [
        'title', 'code','extra_fees', 'stage_id'
    ];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public static function rules($update = false, $id = null)
    {
        $common = [
            'title'        => "required",
            'code'         => "required",
            'extra_fees'   => "nullable|numeric",
            'stage_id'     => "required",
        ];

        if ($update) {
            return $common;
        }

        return array_merge($common, [

        ]);
    }
}
