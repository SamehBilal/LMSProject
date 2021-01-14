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
        $count = 0;

        if($request->filled(['class', 'month'])) {

            $class = Class_room::where('name',$request->input('class'))->first();
            $month = $request->input('month');
            $updatedrecords = [];
            $records = Attendance::where('class_id',$class->id)
                                 ->where('month',$month)
                                 ->get()
                                 ->groupBy('student_id');
            dd($records);
            foreach($records as $key => $record){
                $student = Student::find($key);
                $value = $student->user->fullname;
                $arr[] = $value;
            }

            $count = count($records);
        }
        return view('attendance.index',compact('records','classes','count'));

        // $request->merge([
        //     'user_id' => auth()->id()
        // ]);

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
