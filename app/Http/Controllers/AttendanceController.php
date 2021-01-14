<?php

namespace App\Http\Controllers;

use App\Models\Class_room;
use App\Models\Course;
use App\Models\Student;
use App\Models\Session;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $records = null;
        $classes = Class_room::all();
        $daysInMonth = $students = 0;

        if($request->filled(['class', 'month'])) {

            /**
             * get number of days in selected month.
             */
            $currentmonth = \Carbon\Carbon::parse($request->input('month'));
            $daysInMonth = $currentmonth->daysInMonth;

            $class = Class_room::where('name',$request->input('class'))->first();
            $month = $request->input('month');
            $arr = [];

            /**
            * get each student records in month and group data by student_id.
            */
            $records = Attendance::where('class_id',$class->id)
                                 ->where('month',$month)
                                 ->get()
                                 ->groupBy('student_id');

            foreach($records as $key => $record){
                foreach($record as $anotherrecord){
                    $anotherrecord->daynumber = \Carbon\Carbon::parse($anotherrecord->date)->day;
                }
                $arr[] = $key;
            }
            /**
            * get students names.
            */
            $students = Student::whereIn('id',$arr)->get();

        }
        return view('attendance.index',compact('daysInMonth','students','records','classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
