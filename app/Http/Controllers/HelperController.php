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
        ]);

        if(request()->hasFile('avatar'))
        {
            $this->addNewAvatar($user);
        }

        return $user;
    }

    public function updateuser($data, $id)
    {
        $user = User::where('id', $id)->first();
        $user->update([
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
        ]);

        if(request()->hasFile('avatar'))
        {
                        
            $this->deleteOldAvatar($user);

            $this->addNewAvatar($user);
        }

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

            $staff = Staff::where('user_id',$id)->first();
            $cv = '/storage/'. $staff->user_id . '/' . $staff->cv;
            $path = str_replace('\\','/',public_path());
            
            if(file_exists($path . $cv))
            {
                unlink($path . $cv);
            }
            $staff->delete();

        }elseif ($user->hasRole('student')) {
            $student = Student::where('user_id',$id)->first();

            $document = '/storage/'. $student->user_id . '/' . $student->document;
            $path = str_replace('\\','/',public_path());
            
            if(file_exists($path . $document))
            {
                unlink($path . $document);
            }
            $student->delete();
        }

        $this->deleteOldAvatar($user);

        $user->syncPermissions();
        $user->syncRoles();
        $user->forceDelete();
        
        return back();
    }

    
    public function addNewAvatar($user)
    {
        $avatar = request()->file('avatar')->getClientOriginalName();
        request()->file('avatar')->storeAs('/',$user->id . '/' . $avatar, '');
        $user->update(['avatar' =>  $avatar]);

        return true;
    }

    public function deleteOldAvatar($user)
    {
        $image = '/storage/'. $user->id . '/' . $user->avatar;
        $path = str_replace('\\','/',public_path());
        
        if(file_exists($path . $image))
        {
            unlink($path . $image);
        }
        return true;
    }
}
