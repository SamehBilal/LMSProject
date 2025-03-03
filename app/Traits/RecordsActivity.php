<?php

namespace App\Traits;

use App\Models\Activity;

trait RecordsActivity
{
    /**
     *  This boot function run automaticly from models that use this trait
     *  Usage  type boot + trait name and laravel will run it automaticly
     */
    protected static function bootRecordsActivity()
    {
        if(auth()->guest()) return;

        foreach(static::getActivitiesToRecord() as $event){
            static::$event(function ($model) use ($event){
                $model->recordActivity('created');
            });
        }

    }


    protected static function getActivitiesToRecord()
    {
        return ['created'];
    }


    protected function recordActivity($event)
    {
        // $this->activity()->create([
        //     'type'          =>  $this->getActivityType($event),
        //     'user_id'       =>  auth()->id(),
        // ]);
        Activity::create([
            'type'          =>  $this->getActivityType($event),
            'user_id'       =>  auth()->id(),
            'subject_id'    =>  $this->id,
            'subject_type'  =>  get_class($this)
        ]);
    }

    // public function activity()
    // {
    //     return $this->morphMany('App\Activity', 'subject');
    // }
    protected function getActivityType($event)
    {
        return $event . '_' .strtolower((new \ReflectionClass($this))->getShortName());
    }
} 