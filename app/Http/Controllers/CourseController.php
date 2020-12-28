<?php

namespace App\Http\Controllers;

use App\Course;
use App\Stage;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Course::with('stage')->get();
        return view('school_structure.courses.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stages = Stage::all();
        return view('school_structure.courses.create', compact('stages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Course::rules());

        $data = $request->all();

        Course::create([
            'title'        => $data['title'],
            'code'         => $data['code'],
            'extra_fees'   => $data['extra_fees'],
            'stage_id'     => $data['stage_id'],
            'by_id'        => auth()->user()->id,
        ]);

        return redirect()->route('admin.courses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $stages = Stage::all();
        return view('school_structure.courses.edit', compact('course','stages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, Course::rules());

        $data = $request->all();
        
        Course::where('id',$id)->update([
            'title'        => $data['title'],
            'code'         => $data['code'],
            'extra_fees'   => $data['extra_fees'],
            'stage_id'     => $data['stage_id'],
        ]);

        return redirect()->route('admin.courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Course::destroy($id);
        

        return back();
    }
}
