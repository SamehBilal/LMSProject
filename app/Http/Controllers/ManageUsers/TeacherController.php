<?php

namespace App\Http\Controllers\ManageUsers;

use App\Http\Controllers\Helpers\HelperController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Class_room;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = User::role('teacher')->with('teacher.course')->latest('updated_at')->get();
        return view('manage_users.teachers.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Class_room::all();
        $courses = Course::all();
        return view('manage_users.teachers.create', compact('courses','classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, User::rules());
        $this->validate($request, Teacher::rules());

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        //create user
        $helperController = new HelperController();
        $user = $helperController->createuser($data);

        $teacher = Teacher::create([
            'user_id' => $user->id,
            'course_id' => $data['course_id'],
            'university' => $data['university'],
            'graduation_year' => $data['graduation_year'],
            'salary' => $data['salary'],
        ]);

        $cv = request()->file('cv')->getClientOriginalName();
        request()->file('cv')->storeAs('/',$teacher->user_id . '/' . $cv, '');
        $teacher->update(['cv' =>  $cv]);
        // add data to many to many relation table
        $classes = Class_room::find($request->class_id);
        $teacher->classes()->attach($classes);


        $user->assignRole('teacher');

        return redirect()->route('dashboard.teachers.index');
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
        $classes = Class_room::all();
        $user = User::where('id',$id)->with('Teacher')->first();
        $courses = Course::all();

        return view('manage_users.teachers.edit', compact('user','courses','classes'));

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
        $this->validate($request, User::rules($update = true, $id));
        $this->validate($request, Teacher::rules($update = true));


        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        //update user data
        $helperController = new HelperController();
        $user = $helperController->updateuser($data, $id);

        $teacher = Teacher::where('user_id',$id)->first();
        $teacher->update([
            'user_id' => $user->id,
            'course_id' => $data['course_id'],
            'university' => $data['university'],
            'graduation_year' => $data['graduation_year'],
            'salary' => $data['salary'],
        ]);

        if(request()->hasFile('cv'))
        {
            
            $cv = '/storage/'. $teacher->user_id . '/' . $teacher->cv;
            $path = str_replace('\\','/',public_path());
            
            if(file_exists($path . $cv))
            {
                unlink($path . $cv);
            }

            $cv = request()->file('cv')->getClientOriginalName();
            request()->file('cv')->storeAs('/',$teacher->user_id . '/' . $cv, '');
            $teacher->update(['cv' =>  $cv]);

        }

        // add data to many to many relation table

        $classes = Class_room::find($request->class_id);
        $teacher->classes()->detach($classes);
        $teacher->classes()->attach($classes);

        return redirect()->route('dashboard.teachers.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        

        return back();
    }

    public function viewdeleted()
    {
        $items = User::onlyTrashed()->role('teacher')->with('teacher.course')->latest('updated_at')->get();
        return view('manage_users.teachers.deleted', compact('items'));
    }

}