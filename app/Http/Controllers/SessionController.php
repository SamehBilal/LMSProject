<?php

namespace App\Http\Controllers;

use App\Course;
use App\Session;
use App\Attendance;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $class_id = $id;
        $days =  ['saterday','sunday','monday','tuesday','wednesday','thursday'];

        $courses = Course::all();

        return view('school_structure.classes.createSchedual', compact('class_id','days','courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $start_time = ['','09:00','10:00','11:00','12:00','13:00','14:00'];
        $end_time   = ['','10:00','11:00','12:00','13:00','14:00','15:00'];
        $data = $request->except('_token','class_id');
        foreach ($data as $key => $value) {
            
            $arr = explode('_',trim($key));
                Session::create([
                    'class_id'  => $request->class_id,
                    'course_id' => $value,
                    'day'       => $arr[0],
                    'start'     => $start_time[$arr[1]],
                    'end'       => $end_time[$arr[1]],
                ]);
        }
        return redirect()->route('admin.classes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $class_id = $id;
        $days =  ['saterday','sunday','monday','tuesday','wednesday','thursday'];
        $start_time = ['09:00:00','10:00:00','11:00:00','12:00:00','13:00:00','14:00:00'];

        $courses = Course::all();
        $sessions = Session::where('class_id',$class_id)->get();
        foreach ($sessions as $session) {
            $session->unique = $session->course_id . '_' . $session->day . '_' . $session->start;
        }
        return view('school_structure.classes.editSchedual', compact('class_id','days','courses','sessions','start_time'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $class_room = Session::where('class_id',$request->class_id)->delete();

        $start_time = ['','09:00','10:00','11:00','12:00','13:00','14:00'];
        $end_time   = ['','10:00','11:00','12:00','13:00','14:00','15:00'];
        $data = $request->except('_token','class_id','_method');
        foreach ($data as $key => $value) {
            
            $arr = explode('_',trim($key));
                Session::create([
                    'class_id'  => $request->class_id,
                    'course_id' => $value,
                    'day'       => $arr[0],
                    'start'     => $start_time[$arr[1]],
                    'end'       => $end_time[$arr[1]],
                ]);
        }
        return redirect()->route('admin.classes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        //
    }
}
