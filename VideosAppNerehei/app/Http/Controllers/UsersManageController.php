<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class UsersManageController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.manage.index', compact('users'));
    }

    public function create()
    {
        return view('users.manage.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string',
            'role' => 'required|string|in:,super_admin,video_manager,regular',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        $user = User::create($validatedData);

        if ($validatedData['role'] !== 'regular') {
            $user->assignRole($validatedData['role']);
        }

        return redirect()->route('users.show', $user->id);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.manage.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);


        $user = User::findOrFail($id);
        $user->update($validatedData);
        return redirect()->route('users.manage.index', $user->id);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        return view('users.manage.delete', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.manage.index');
    }
}
