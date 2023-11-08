<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Validator;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('pages.register');
    }

    public function register(Request $request)
    {
        $request->validate(
            [
                'name'              =>      'required|string|max:20',
                'email'             =>      'required|email|unique:users,email',
                'password'          =>      'required|min:6',
                'cpassword'  =>      'required|same:password',
            ],
            [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'password.required' => 'Password is required',
                'cpassword.required' => 'Confirmataion Password is required',
                'email.unique' => 'This email address already has an account associated with it',
                'password.min' => 'The minimum password length is 6 characters',
                'cpassword.same' =>'The confirmation password does not match',
            ]
        );


        event(new Registered($user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ])));

        Auth::login($user);

        return redirect()->route('dashboard')->with(['message' => 'Registration success', 'alert' => 'alert-success']);
    }
    public function store(Request $request)
    {

        $request->validate(
            [
                'name'              =>      'required|string|max:20',
                'email'             =>      'required|email|unique:users,email',
                'password'          =>      'required|min:6',
                'cpassword'  =>      'required|same:password',
            ]
        );

        $dataArray      =       array(
            "name"          =>          $request->name,
            "email"         =>          $request->email,
            "phone"         =>          $request->phone,
            "address"       =>          $request->address,
            "password"      =>          $request->password
        );

        $user           =       User::create($dataArray);
        if (!is_null($user)) {
            return back()->with("success", "Success! Registration completed");
        } else {
            return back()->with("failed", "Alert! Failed to register");
        }
    }
}
