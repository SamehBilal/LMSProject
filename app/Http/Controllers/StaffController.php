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
        return view('manage_users.staff.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage_users.staff.create');
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

        //create user
        $helperController = new HelperController();
        $user = $helperController->createuser($data);

        Staff::create([
            'user_id' => $user->id,
            'position' => $data['position'],
            'major' => $data['major'],
            'university' => $data['university'],
            'graduation_year' => $data['graduation_year'],
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
        return view('manage_users.staff.edit', compact('user'));

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


        Staff::where('user_id',$id)->update([
            'position' => $data['position'],
            'major' => $data['major'],
            'university' => $data['university'],
            'graduation_year' => $data['graduation_year'],
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
        User::destroy($id);
        

        return back();
    }

    public function viewdeleted()
    {
        $items = User::onlyTrashed()->role('staff')->latest('updated_at')->get();
        return view('manage_users.staff.deleted', compact('items'));
    }

}