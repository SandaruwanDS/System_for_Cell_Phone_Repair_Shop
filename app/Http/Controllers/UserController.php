<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // function viewUsers(){
    //     $data = user::all();
    //     return view("user.viewUsers")->with("users" , $data);
    // }

    public function showAddUser (){
        return view('addUserForm');
    }

    public function showRoles(){
        return view('roles');
    }

    public function AddUser(Request $request){
        $prefix = $request->surname;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $fname = $prefix." ".$first_name." ".$last_name;

        
        $data = new user;
        $data->email = $request->email;
        $data->name = $fname;
        $data->username = $request->user_name;
        $data -> password = Hash::make($request->password);
        $data -> role =$request->role;
        $data->save();

        return redirect('/users')->with("added" , "User Added Succsessfully");
    }

    function deleteUsers($id){
        $data = user::find($id);
        $data->delete();
        return redirect()->back()->with("delete", "User deleted");
    }



    function editUsers($id){
        $data = user::find($id);
        return view("editUser")->with("users" , $data);
    }



}
