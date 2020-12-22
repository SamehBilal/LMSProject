<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Staff;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = User::role('staff')->latest('updated_at')->get();
        return view('admin.staff.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.staff.create');
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
        $this->validate($request, Staff::rules());

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $user = User::create([
            'username' => $data['username'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'password' => $data['password'],
            'other_email' => $data['other_email'],
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'avatar' => $request->avatar,
        ]);

        Staff::create([
            'user_id' => $user->id,
            'position' => $data['position'],
            'address' => $data['address'],
            'major' => $data['major'],
            'university' => $data['university'],
            'graduation_year' => $data['graduation_year'],
            'date_of_birth' => $data['date_of_birth'],
            'cv' => $request->cv,
            'salary' => $data['salary'],
        ]);
        $user->assignRole('staff');

        return redirect()->route('admin.staff.index');
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
        $user = User::where('id',$id)->with('staff')->first();
        return view('admin.staff.edit', compact('user'));

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
        $user = User::where('id',$id)->update([
            'username' => $data['username'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'password' => $data['password'],
            'other_email' => $data['other_email'],
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'avatar' => $request->avatar,
        ]);

        Staff::where('user_id',$id)->update([
            'user_id' => $id,
            'position' => $data['position'],
            'address' => $data['address'],
            'major' => $data['major'],
            'university' => $data['university'],
            'graduation_year' => $data['graduation_year'],
            'date_of_birth' => $data['date_of_birth'],
            'cv' => $request->cv,
            'salary' => $data['salary'],
        ]);

        return redirect()->route('admin.staff.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff = Staff::where('user_id',$id)->first();
        Staff::destroy($staff->id);
        $user = User::find($id);
        $user->syncPermissions();
        $user->syncRoles();

        User::destroy($id);
        

        return back();
    }

}