<?php

namespace Database\Seeders;

use App\Helpers\video_helpers;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Seeder;
use App\Helpers\CreateUsers;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() : void
    {
        User::truncate();
        Video::truncate();
        Role::truncate();

        video_helpers::getDefaultValues();

        // Create Roles
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $regularUserRole = Role::create(['name' => 'regular-user']);
        $videoManagerRole = Role::create(['name' => 'video-manager']);

        // Create default users
        $superAdmin = CreateUsers::create_superadmin_user();
        $regularUser = CreateUsers::create_regular_user();
        $videoManager = CreateUsers::create_video_manager_user();

        // Assign permissions to users
        if ($superAdmin) {
            $superAdmin->givePermissionTo('manage videos');
            $superAdmin->givePermissionTo('manage users');
        }

        if ($videoManager) {
            $videoManager->givePermissionTo('manage videos');
        }
    }
}
