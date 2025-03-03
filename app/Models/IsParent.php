<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;

class IsParent extends Model
{
    use  RecordsActivity;
    protected $table = 'parents';

    public $timestamps = false;

    protected $fillable = [
        'parent_id', 'student_id'
    ];
    public function user()
    {
        return $this->hasOne(User::class , "id" , "student_id");
    }
    public static function rules($update = false, $id = null)
    {
        $common = [

        ];

        if ($update) {
            return $common;
        }

        return array_merge($common, [
        ]);
    }
}
