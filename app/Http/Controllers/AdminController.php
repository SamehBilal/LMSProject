<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = User::role('admin')->latest('updated_at')->get();
        return view('admin.admins.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admins.create');
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
        $user->assignRole('admin');

        return redirect()->route('admin.admins.index');
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
        $user = User::find($id);
        return view('admin.admins.edit', compact('user'));

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

        return redirect()->route('admin.admins.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->syncPermissions();
        $user->syncRoles();

        User::destroy($id);
        

        return back();
    }
}
