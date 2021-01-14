<?php

namespace App\Http\Controllers;

use App\Models\Class_room;
use App\Models\Stage;
use App\Models\Session;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Class_room::with('stage')->get();
        return view('school_structure.classes.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stages = Stage::all();

        return view('school_structure.classes.create', compact('stages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, Class_room::rules());

        $data = $request->all();

        $class = Class_room::create([
            'name'          => $data['name'],
            'code'          => $data['code'],
            'school_name'   => $data['school_name'],
            'status'        => $data['status'],
            'stage_id'      => $data['stage_id'],
        ]);


        return redirect()->route('dashboard.classes.index');
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
        $class = Class_room::findOrFail($id);
        $stages = Stage::all();
        return view('school_structure.classes.edit', compact('class','stages'));
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
        $this->validate($request, Class_room::rules());

        $data = $request->all();
        
        Class_room::where('id',$id)->update([
            'name'          => $data['name'],
            'code'          => $data['code'],
            'school_name'   => $data['school_name'],
            'status'        => $data['status'],
            'stage_id'     => $data['stage_id'],
        ]);

        return redirect()->route('dashboard.classes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Session::where('class_id',$request->class_id)->delete();
        Class_room::destroy($id);
        

        return back();
    }
}
