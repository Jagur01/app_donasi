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

    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'roles_id' => '2'
        ]);
    }
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Simpan user baru ke database
        $user = $this->create($request->all());

        if ($user) {
            return response()->json([
                'status' => 'success',
                'message' => 'Registrasi berhasil! Silakan login.'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat registrasi.'
            ], 500);
        }
    }

    // /**
    //  * Handle a successful registration.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\User  $user
    //  * @return \Illuminate\Http\Response
    //  */
    // protected function registered(Request $request, $user)
    // {
    //     // Log the user out immediately after registration
    //     Auth::logout();

    //     // Redirect to the login page after logout
    //     return redirect('/login')->with('status', 'Registration successful, please log in.');
    // }
}