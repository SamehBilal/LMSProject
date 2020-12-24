<?php

namespace App\Http\Controllers;

use App\User;
use App\Staff;
use App\Student;
use App\IsParent;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function createuser($data)
    {
        $user = User::create([
            'username'      => $data['username'],
            'firstname'     => $data['firstname'],
            'lastname'      => $data['lastname'],
            'fullname'      => $data['fullname'],
            'email'         => $data['email'],
            'password'      => $data['password'],
            'other_email'   => $data['other_email'],
            'phone'         => $data['phone'],
            'phone2'        => $data['phone2'],
            'gender'        => $data['gender'],
            'religion'      => $data['religion'],
            'date_of_birth' => $data['date_of_birth'],
            'address'       => $data['address'],
            // 'avatar'        => $request->avatar,
        ]);

        return $user;
    }

    public function updateuser($data, $id)
    {
        $user = User::where('id',$id)->update([
            'username'      => $data['username'],
            'firstname'     => $data['firstname'],
            'lastname'      => $data['lastname'],
            'fullname'      => $data['fullname'],
            'email'         => $data['email'],
            'password'      => $data['password'],
            'other_email'   => $data['other_email'],
            'phone'         => $data['phone'],
            'phone2'        => $data['phone2'],
            'gender'        => $data['gender'],
            'religion'      => $data['religion'],
            'date_of_birth' => $data['date_of_birth'],
            'address'       => $data['address'],
            // 'avatar' => $request->avatar,
        ]);

        return $user;
    }

    public function restore($id)
    {


        $user = User::where('id',$id)->withTrashed()->first();
        $user->restore();
        return back();
    }

    public function forcedelete($id)
    {


        $user = User::where('id',$id)->withTrashed()->first();
        if($user->hasRole('admin'))
        {


        }elseif ($user->hasRole('parent')) {

            IsParent::where('parent_id',$id)->delete();

        }elseif ($user->hasRole('staff') || $user->hasRole('teacher')) {

            Staff::where('user_id',$id)->first()->delete();

        }elseif ($user->hasRole('student')) {
            Student::where('user_id',$id)->first()->delete();
        }

        $user->syncPermissions();
        $user->syncRoles();
        $user->forceDelete();
        
        return back();
    }
}
