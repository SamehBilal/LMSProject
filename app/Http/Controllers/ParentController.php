<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\IsParent;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ParentController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = User::role('parent')->with('parentTo')->latest('updated_at')->get();
        return view('manage_users.parents.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = User::role('student')->get();
        return view('manage_users.parents.create', compact('students'));
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
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        //create user
        $helperController = new HelperController();
        $user = $helperController->createuser($data);

        foreach ($request->students as $student) {
            $parent = new IsParent;

            $parent->parent_id = $user->id;
            $parent->student_id = $student;
            $parent->save();
        }


        $user->assignRole('parent');

        return redirect()->route('admin.parents.index');
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
        $user = User::where('id',$id)->first();
        $students = User::role('student')->get();
        return view('manage_users.parents.edit', compact('user','students'));

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
        $this->validate($request, Staff::rules($update = true));


        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        //update user data
        $helperController = new HelperController();
        $user = $helperController->updateuser($data, $id);


        // foreach ($request->students as $student) {
        //     $parent = new IsParent;

        //     $parent->parent_id = $user->id;
        //     $parent->student_id = $student;
        //     $parent->save();
        // }

        return redirect()->route('admin.parents.index');

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
        $items = User::onlyTrashed()->role('parent')->latest('updated_at')->get();
        return view('manage_users.parents.deleted', compact('items'));
    }

}
