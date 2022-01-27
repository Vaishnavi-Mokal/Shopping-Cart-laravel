<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function index()
    {
        return view('admin.dashboard.UserManage');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $input = Input::all();
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8','regex:/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/','confirmed'],
            'password_confirmation' => ['required','min:8','same:password'],
            'status' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string']
        ],
        
        $messages = [
            'firstname.required'=>'FirstName is Required',
            'lastname.required'=>'LastName  is Required',
            'email.required'=>'Email is Required',
            'email.regex'=>'Enter email in correct order',
            'password.required'=>'Password is Required',
            'password.regex'=>"Password must contain atleast one symbole, one capital letter, one integer and Maximum length must be 8 character",
            'password_confirmation.same' => 'Password Confirmation should match the Password',
            'status.required'=>'Status is Required',
            'role.required'=>'Role Required'
        ]);
        $validator = Validator::make($input, $rules, $messages);
        
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->messages());
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\UserManage
     */
    protected function create(array $data)
    {
        return UserManage::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => $data['status'],
            'role' => $data['role']
        ]);
    }
}
