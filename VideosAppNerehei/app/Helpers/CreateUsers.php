<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\Team;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
                'super_admin' => false,
            ]), function (User $user) {
                self::creacioTeam($user);
            });
        });
    }

    static protected function creacioTeam(User $user)
    {
        $user->ownedTeams()->create([
            'name' => "{$user->name}'s Team",
            'personal_team' => true,
        ]);
    }

    static protected function add_personal_team(User $user)
    {
        $team = Team::create([
            'user_id' => $user->id,
            'name' => $user->name . "'s Team",
            'personal_team' => true,
        ]);

        $user->teams()->attach($team->id);
    }

    static public function create_regular_user()
    {
        $user = User::create([
            'name' => 'Regular User',
            'email' => 'regular@videosapp.com',
            'password' => bcrypt('123456789'),
            'super_admin' => false,
        ]);

        self::add_personal_team($user);

        return $user;

    }

    static public function create_video_manager_user()
    {
        $user = User::create([
            'name' => 'Video Manager',
            'email' => 'videosmanager@videosapp.com',
            'password' => bcrypt('123456789'),
            'super_admin' => false,
        ]);
        self::add_personal_team($user);

        return $user;

    }

    static public function create_superadmin_user()
    {
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@videosapp.com',
            'password' => bcrypt('123456789'),
            'super_admin' => true,
        ]);

        self::add_personal_team($user);

        return $user;
    }

    static public function create_role_and_permissions()
    {
        $permissions = [
            'super_admin',
            'video_manager',
            'serie_manager'
        ];

        foreach ($permissions as $perm) {
            if (!Permission::where('name', $perm)->exists()) {
                Permission::firstOrCreate(['name' => $perm]);
            }
        }

        $adminRole = Role::firstOrCreate(['name' => 'super_admin']);
        $videoManagerRole = Role::firstOrCreate(['name' => 'video_manager']);

        if (!$adminRole->hasPermissionTo('super_admin')) {
            $adminRole->givePermissionTo('super_admin');
        }
        if (!$adminRole->hasPermissionTo('video_manager')) {
            $adminRole->givePermissionTo('video_manager');
        }
        if (!$adminRole->hasPermissionTo('serie_manager')) {
            $adminRole->givePermissionTo('serie_manager');
        }
        if (!$videoManagerRole->hasPermissionTo('video_manager')) {
            $videoManagerRole->givePermissionTo('video_manager');
        }
        if (!$videoManagerRole->hasPermissionTo('serie_manager')) {
            $videoManagerRole->givePermissionTo('serie_manager');
        }
    }
}
