<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\TestMail;
use App\Models\Billing;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\userController;

class userController extends Controller
{
    public function index()
    {

        $users = User::when(request('search') != '', function($q) {
            $q->where('name', 'like', '%' . request('search') . '%')
            ->orwhere('email', 'like', '%' . request('search') . '%');
        })->paginate(3);
        if ( Gate::allows('admin-only')) {
            
        return view('users.admin_dashboard', ['data' => $users]);
        }
        else{
            return'405! Method Not Allowed!';
        }
    }

    // Getting Form For Add Distributor

    public function create(){
        if(Gate::allows('admin-only')){
        return view("users.add_distributor");
        }
        else{
            return"405! Method Not Allowed!";
        }
    }

    // Add Distributor Code

    public function store(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'contact' => 'required|string|max:11',
                'image'=>'required|file|max:255',
            ]);
            
            $user= new User;
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=Hash::make($request->password);
            $user->set_as= 0;
            $user->contact=$request->contact;
            $user->payment=$request->payment;

            // $user->image= $request->image;
            if($request->hasfile('image')){
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension(); 
                    // getting image extention
                    $filename = time().'.'. $extension;
                    $file->move('images/', $filename);
                    $user->image = $filename;
                }
                else{
                        // return $request;
                        $user->image='';
                    }
            $user->save();
            return redirect('users')->with('Distributor Added Successfully');

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

        public function AdminLogin(Request $request)
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


        //  Logout Code

        public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('admin-login');
    }

    //  Change Password Get Form Code

    public function UpdatePassword(){
        if(Gate::allows('distributor-only')){
        return view('users.password');
        }
        else{
            return"405! Method Not Allowed!";
        }
    }

        //  Change Password Code

        public function SetPassword(Request $request){
            $user=auth()->user();
            if(Hash::check($request->old_password,$user->password)){

                $user->password=Hash::make($request->password);
                $user->save();

            }
            else{
               return response()->json(['message' => 'Passwords are not matched'], 428);
            }
        }


        // upload image code

        public function UpdateImage(){

            return view('users.upload-image');
        }

        public function UploadImage(Request $request)
        {
            
            $request->validate([
                'image'=>'required|file|max:255',
            ]);
            $user=User::where('id',Auth::user()->id)->first();
            if($request->hasfile('image')){
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension(); 
                // getting image extention
                $filename = time().'.'. $extension;
                $file->move('images/', $filename);
                $user->image = $filename;
            }
            else{
                    // return $request;
                    $user->image='';
                }
        $user->save();
        return redirect('items/home');
        }

        public function edit()
        {
            return view('users.edit');
        }


        public function UpdateProfile(Request $request)
        {
            
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'contact' => 'required|string|max:11',
            ]);
            $user=User::where('id',Auth::user()->id)->first();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->contact = $request->contact;
            $user->save();
        }

        public function edit_distributor(User $user)
        {
            if ( Gate::allows('admin-only', $user)) {
            return view('users.edit-distributor',['user'=>$user]);
            }
            else{
                return'You are Not Eligible'; 
            }
        }

        public function UpdateDistributor(Request $request)
        {
            
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'contact' => 'required|string|max:11',
            ]);
            $user=User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->contact = $request->contact;
            $user->save();
        }

    public function delete(User $user)
            {
                if ( Gate::allows('admin-only', $user)) {
                $user->delete();
            }
            else{
                return'You are Not Eligible';
                }
            }


}