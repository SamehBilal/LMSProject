<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // auth()->user()->assignRole('Super Admin');

        // // dd(auth()->user()->hasRole('admin'));
        // $role = Role::create(['name' => 'moderator']);
        // $role->givePermissionTo('delete meeting');

        // // $permission = Permission::create(['name' => 'delete meeting']);
        // $user = auth()->user();
        // $user->assignRole('admin');
        // $user->assignRole($role);
        // $user->givePermissionTo('delete meeting');

        return view('home');
    }
}
