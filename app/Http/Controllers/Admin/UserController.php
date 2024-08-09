<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // buatkan Crud untuk User
    public function index()
    {
        // $users = User::latest()->paginate(5);
        // terapkan fitur search
        $users = User::when(request('keyword'), function ($query) {
            $query->where('name', 'like', '%' . request('keyword') . '%')
                ->orWhere('email', 'like', '%' . request('keyword') . '%');
        })->paginate(5);
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $users = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        if ($users) {
            return redirect()->route('user.index')->with(['success' => 'Data Berhasil']);
        } else {
            return redirect()->route('user.index')->with(['error' => 'Data Gagal']);
        }
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::findOrFail($user->id);
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        if ($user) {
            return redirect()->route('user.index')->with(['success' => 'Data Berhasil']);
        } else {
            return redirect()->route('user.index')->with(['error' => 'Data Gagal']);
        }
    }

    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();

        if ($users) {
            return redirect()->route('user.index')->with(['success' => 'Data Berhasil']);
        } else {
            return redirect()->route('user.index')->with(['error' => 'Data Gagal']);
        }
    }
}
