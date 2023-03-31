<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ], [

            'name.required' => 'Name field is required.',
            'email.required' => 'Email field is required.',
            'email.email' => 'Email field must be email address.',
            'password.required' => 'Password field is required.'

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        if($user){
            return redirect("login")->withSuccess('Registration successful');
        }else{
            return redirect("login")->withErrors('Something went wrong');
        }

    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $authUser = Auth::user();
            if($authUser->status == 'active'){
                return redirect("dashboard")->withSuccess('Signed in Successfully');
            }else{
                return redirect("login")->withErrors(['status_error' => 'Your account is '. Auth::user()->status . '. Please contact your administrator']);
            }
            // return redirect()->intended('dashboard')->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function dashboard()
    {
        if(Auth::check() && Auth::user()->status == 'active'){
            $allUsers = User::all();
            // dd($allUsers);
            return view('dashboard', compact('allUsers'));
        }
        $userStatus = Auth::user() ? Auth::user()->status : 'inactive or blocked';
        Session::flush();
        Auth::logout();
        return redirect("login")->withErrors(['status_error' => 'Your account is '. $userStatus . '. Please contact your administrator']);
    }

    public function updateUser(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'user_email' => 'required|email',
        ], [

            'fullname.required' => 'Name field is required.',
            'user_email.required' => 'Email field is required.',
            'user_email.email' => 'Email field must be email address.'

        ]);
        // dd($request->all());
        if(Auth::user()){
            User::where('id', $request->user_id)->update(['name' => $request->fullname, 'email'=> $request->user_email , 'status' => $request->user_status]);

            return redirect("dashboard")->withSuccess('User Updated Successfully');
        }
        return redirect("dashboard")->withErrors(['user_error' => 'Something went wrong']);
    }
    public function deleteUser(Request $request)
    {
        if(Auth::user()){
            User::where('id', $request->user_id)->delete();
            return redirect("dashboard")->withSuccess('User Deleted Successfully');
        }
        return redirect("dashboard")->withErrors(['user_error' => 'Something went wrong']);
    }

    public function signOut() {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
