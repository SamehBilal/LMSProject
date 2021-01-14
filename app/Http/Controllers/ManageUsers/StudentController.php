<?php

namespace App\Http\Controllers\ManageUsers;

use App\Http\Controllers\Helpers\HelperController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Stage;
use App\Models\Student;
use App\Models\Class_room;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = User::role('student')->with('student')->latest('updated_at')->get();
        return view('manage_users.students.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Class_room::all();
        $stages  = Stage::all();
        return view('manage_users.students.create', compact('classes','stages'));
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
        $this->validate($request, Student::rules());

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        //create user
        $helperController = new HelperController();
        $user = $helperController->createuser($data);

        $student = Student::create([
            'user_id'   => $user->id,
            'serial'    => $data['serial'],
            'stage_id'  => $data['stage_id'],
            'class_id'  => $data['class_id'],
            'status'    => $data['status'],
            'blood_type'=> $data['blood_type'],
        ]);

        $document = request()->file('document')->getClientOriginalName();
        request()->file('document')->storeAs('/',$student->user_id . '/' . $document, '');
        $student->update(['document' =>  $document]);

        $user->assignRole('student');

        return redirect()->route('dashboard.students.index');
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
        $user = User::where('id',$id)->with('student')->first();
        $classes = Class_room::all();
        $stages  = Stage::all();
        return view('manage_users.students.edit', compact('user','classes','stages'));

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

        $student = Student::where('user_id',$id)->first();
        $this->validate($request, Student::rules($update = true, $student->id));


        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        //update user data
        $helperController = new HelperController();
        $user = $helperController->updateuser($data, $id);

        $student = Student::where('user_id',$id)->first();
        $student->update([
            'serial'    => $data['serial'],
            'stage_id'  => $data['stage_id'],
            'class_id'  => $data['class_id'],
            'document'  => $request->document,
            'status'    => $data['status'],
            'blood_type'=> $data['blood_type'],
            ]);
        if(request()->hasFile('document'))
        {
            
            $document = '/storage/'. $student->user_id . '/' . $student->document;
            $path = str_replace('\\','/',public_path());
            
            if(file_exists($path . $document))
            {
                unlink($path . $document);
            }

            $document = request()->file('document')->getClientOriginalName();
            request()->file('document')->storeAs('/',$student->user_id . '/' . $document, '');
            $student->update(['document' =>  $document]);

        }
        return redirect()->route('dashboard.students.index');

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
        $items = User::onlyTrashed()->role('student')->with('student')->latest('updated_at')->get();
        return view('manage_users.students.deleted', compact('items'));
    }
}