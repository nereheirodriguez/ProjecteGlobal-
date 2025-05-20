<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Exception;

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
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'role' => 'required|string|in:super_admin,video_manager,regular',
            ]);

            $validatedData['password'] = bcrypt($validatedData['password']);
            $user = User::create($validatedData);

            $user->ownedTeams()->create([
                'name' => "{$user->name}'s Team",
                'personal_team' => true,
            ]);

            if ($validatedData['role'] !== 'regular') {
                $user->assignRole($validatedData['role']);
            }

            return redirect()->route('users.show', $user->id)
                ->with('success', "S’ha creat l’usuari ‘{$user->name}’!");
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', "Error al crear l’usuari: {$e->getMessage()}");
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.manage.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'role' => 'required|string|in:super_admin,video_manager,regular',
            ]);

            $user = User::findOrFail($id);
            $user->update($validatedData);

            if ($validatedData['role'] !== 'regular') {
                $user->syncRoles([$validatedData['role']]);
            } else {
                $user->syncRoles([]);
            }

            return redirect()->route('users.manage.index')
                ->with('success', "S’ha editat l’usuari ‘{$user->name}’!");
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', "Error al editar l’usuari: {$e->getMessage()}");
        }
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        return view('users.manage.delete', compact('user'));
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $name = $user->name;
            $user->delete();

            return redirect()->route('users.manage.index')
                ->with('success', "S’ha eliminat l’usuari ‘{$name}’!");
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', "Error al eliminar l’usuari: {$e->getMessage()}");
        }
    }
}
