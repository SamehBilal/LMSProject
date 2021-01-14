<?php

namespace App\Http\Controllers\ManageUsers;

use App\Http\Controllers\Helpers\HelperController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\IsParent;
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
        $items = User::role('parent')->with('parentTo.user.student.class')->latest('updated_at')->get();
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

        return redirect()->route('dashboard.parents.index');
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


        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        //update user data
        $helperController = new HelperController();
        $user = $helperController->updateuser($data, $id);

        // update parent relation table delete old and add updated
        IsParent::where('parent_id',$id)->delete();
        $user = User::where('id',$id)->first();
        foreach ($request->students as $student) {
            $parent = new IsParent;

            $parent->parent_id = $user->id;
            $parent->student_id = $student;
            $parent->save();
        }

        return redirect()->route('dashboard.parents.index');

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
