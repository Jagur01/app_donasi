<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterController extends Controller
{
    use RegistersUsers;

    // Redirect path after successful registration
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get the validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
      
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'roles_id' => '2'
        ]);

        // $user = new User();
        // $user->name = $data['name'];
        // $user->email = $data['email'];
        // $user->password = Hash::make($data['password']);
        // $user->roles_id = 2;
        // $user->save();

        if($user){
            return redirect()->route('login')->with(['success' => 'Registration successful, please log in.']);
        }else{
            return redirect()->route('register')->with(['error' => 'Registration failed, please try again.']);
        }

        // return redirect('/login')->with('status', 'Registration successful, please log in.');
    }

    /**
     * Handle a successful registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    protected function registered(Request $request, $user)
    {
        // Log the user out immediately after registration
        Auth::logout();

        // Redirect to the login page after logout
        return redirect('/login')->with('status', 'Registration successful, please log in.');
    }
}
