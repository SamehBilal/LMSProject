<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Student;
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
        return view('manage_users.students.create');
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

        return redirect()->route('admin.students.index');
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
        return view('manage_users.students.edit', compact('user'));

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


        Student::where('user_id',$id)->update([
            'serial'    => $data['serial'],
            'stage_id'  => $data['stage_id'],
            'class_id'  => $data['class_id'],
            'document'  => $request->document,
            'status'    => $data['status'],
            'blood_type'=> $data['blood_type'],
            ]);
        if(request()->hasFile('document'))
        {
            
            $student = Student::where('user_id',$id)->first();
            
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
        return redirect()->route('admin.students.index');

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