<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $data['users'] = User::all();
        return view('admin.users.index', $data);
    }

    public function create()
    {
        $data['users'] = User::pluck('name', 'id');
        $data['roles'] = Role::pluck('name', 'id');
        return view('admin.users.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone_number' => 'required|numeric|digits_between:10,13',
            'password' => 'required|string|min:8',
            'address' => 'required|max:255',
            'role_id' => 'required|exists:roles,id',
        ]);

        User::create($validated);

        $notification = array(
            'message' => 'Data User berhasil ditambahkan',
            'alert-type' => 'success'
        );

        if ($request->has('save')) {
            return redirect()->route('user')->with($notification);
        } else {
            return redirect()->route('user.create')->with($notification);
        }
    }

    public function edit(string $id)
    {
        $data['user'] = User::find($id);
        $data['users'] = user::pluck('name', 'id');

        return view('admin.users.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone_number' => 'required|numeric|digits_between:10,13',
            'password' => 'required|string|min:8',
            'address' => 'required|max:255',
            'role_id' => 'required|exists:roles,id',
        ]);


        $user->update($validated);
        $notification = array(
            'message' => 'Data User berhasil diperbaharui',
            'alert-type' => 'success'
        );
        return redirect()->route('user')->with($notification);
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        $notification = array(
            'message' => 'Data User berhasil dihapus',
            'alert-type' => 'success'
        );
        return redirect()->route('user')->with($notification);
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        $users = User::where('name', 'like', "%{$query}%")->get();

        return view('admin.users.index', compact('users'));
    }
}
