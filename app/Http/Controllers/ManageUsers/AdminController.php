<?php

namespace App\Http\Controllers\ManageUsers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\HelperController;
use Illuminate\Http\Request;
use App\Models\User;
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
        $items = User::role('admin')->with('permissions','roles')->latest('updated_at')->get();
        return view('manage_users.admins.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage_users.admins.create');
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

        //create user data
        $helperController = new HelperController();
        $user = $helperController->createuser($data);

        $user->assignRole('admin');

        return redirect()->route('dashboard.admins.index');
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
        return view('manage_users.admins.edit', compact('user'));

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

        return redirect()->route('dashboard.admins.index');

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
        $items = User::onlyTrashed()->role('admin')->latest('updated_at')->get();
        return view('manage_users.admins.deleted', compact('items'));
    }
}
