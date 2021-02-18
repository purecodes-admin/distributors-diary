<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\userController;

class userController extends Controller
{
    public function index()
    {

        $users = User::all();
        return view('users.admin_dashboard', ['data' => $users]);
    }

    public function store(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);
            
            $user= new User;
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=Hash::make($request->password);
            $user->set_as= 0;
            $user->save();

            // event(new Registered($user));

            $details=[
                'title'=>'Mail From The Admin',
                'body'=>'This is the Test email By using Gmail.',
                'password'=> $request->password,
                'message'=>'You are Registered Successfully as Distributor Click The link below to start your journey',
                'link'=>'http://127.0.0.1:8000/login'
            ];
            Mail::to($user->email)->send(new TestMail($details));
        }

        // Admin Login Code

        public function authenticate(Request $request)
        {
            $credentials = $request->only('email', 'password');   

            // $credentials['set_as'] = 1; 2nd method to pass data

            if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'set_as' => 1])) {
                $request->session()->regenerate();
    
                return redirect()->intended('users');
            }
    
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }



        public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('admin-login');
    }





        // public function UpdatePassword($id){
        //     $user=User::find($id);
		// return view('user.password',['data'=>$user]);
        // }

        public function SetPassword(Request $request){
            $user=auth()->user();
            if(Hash::check($request->old_password,$user->password)){

                $user->password=Hash::make($request->password);
                $user->save();

            }
            else{
                return redirect()->back()->with('error','Old Pasword Does not Match');
            }
        }

}
