<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserManage;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;



class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::all();
        return view('admin.dashboard.UserManage',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData=$request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:users',
            'password'=>'required||min:10|regex:/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/',
            'status'=>'required'
        ],[
            'firstname.required'=>'FirstName is Required',
            'lastname.required'=>'LastName  is Required',
            'email.required'=>'Email is Required',
            'email.regex'=>'Enter email in correct order',
            'password.required'=>'Password is Required',
            'password.regex'=>"Password must contain atleast one symbol, one capital letter, one integer and Maximum length must be 10 character",
            'status.required'=>'Status is Required'
        ]);
        if($validateData)
        {
            $fname=$request->firstname;
            $lname=$request->lastname;
            $email=$request->email;
            $password=$request->password;
            $status=$request->status;
            $role=$request->role;

            $usermanage=new User();
            $usermanage->firstname=$fname;
            $usermanage->lastname=$lname;
            $usermanage->email=$email;
            $usermanage->password=Hash::make($request->password);
            $usermanage->status=$status;
            $usermanage->role=$role;
            if($usermanage->save())
            {
                return back()->with('success','User Data Added!!');
            }
            else {
                
                return back()->with('errMesg','Data not Added');
            }

        }
        else {
            
            return back()->with('errMsg','Uploading Error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $users=User::all();
        return view('admin.dashboard.UserList',['users'=>$users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users=User::where('id',$id)->first();
        $selectedtype=Role::where('role_name',$users->role)->first();
        $roles = Role::all();
        return view('admin.dashboard.EditUser',compact('users','roles','selectedtype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $validateData=$request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'
        ],[
            'firstname.required'=>'FirstName is Required',
            'lastname.required'=>'LastName  is Required',
            'email.required'=>'Email is Required',
            'email.regex'=>'Enter email in correct order'
        ]);

        if($validateData){
            $fname=$request->firstname;
            $lname=$request->lastname;
            $email=$request->email;
            $status=$request->status;
            $role=$request->role;
            $userid=$request->userid;
            User::where('id',$userid)->update([
                'firstname'=>$request->firstname,
                'lastname'=>$request->lastname,
                'email'=>$request->email,
                'status'=>$request->status,
                'role'=>$request->role
            ]);
            return back()->with('success',"Details Added !");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        User::where('id',$request->aid)->delete();
        return back();
    }
}
