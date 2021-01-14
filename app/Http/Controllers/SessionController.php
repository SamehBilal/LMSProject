<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Session;
use App\Models\Attendance;
use App\Models\SessionTime;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $days = ['saterday','sunday','monday','tuesday','wednesday','thursday'];

    
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
        $days =  $this->days;

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
        $session_time = SessionTime::all()->pluck('id');

        $data = $request->except('_token','class_id');
        foreach ($data as $key => $value) {
            
            $arr = explode('_',trim($key));
                Session::create([
                    'class_id'  => $request->class_id,
                    'course_id' => $value,
                    'day'       => $arr[0],
                    'session_time_id'   => $session_time[$arr[1] - 1]
                ]);
        }
        return redirect()->route('dashboard.classes.index');
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
        $days =  $this->days;
        $session_time = SessionTime::all()->pluck('id');
        $courses = Course::all();
        $sessions = Session::where('class_id',$class_id)->get();
        foreach ($sessions as $session) {
            $session->unique = $session->course_id . '_' . $session->day . '_' . $session->session_time_id;
        }
        return view('school_structure.classes.editSchedual', compact('class_id','days','courses','sessions','session_time'));
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
        Session::where('class_id',$request->class_id)->delete();
        $session_time = SessionTime::all()->pluck('id');

        $data = $request->except('_token','class_id','_method');
        foreach ($data as $key => $value) {
            
            $arr = explode('_',trim($key));
                Session::create([
                    'class_id'  => $request->class_id,
                    'course_id' => $value,
                    'day'       => $arr[0],
                    'session_time_id'   => $session_time[$arr[1] - 1]
                ]);
        }
        return redirect()->route('dashboard.classes.index');
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
