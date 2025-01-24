<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateUsers
{
    static public function creacioUsuariDefecte(array $user)
    {
        Validator::make($user, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ])->validate();

        return DB::transaction(function () use ($user) {
            return tap(User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]), function (User $user) {
                self::creacioTeam($user);
            });
        });
    }

    static protected function creacioTeam(User $user)
    {
        // Create a team for the user
        $user->ownedTeams()->create([
            'name' => "{$user->name}'s Team",
            'personal_team' => true, // Ensure the personal_team field is set
        ]);
    }
}
