<?php

namespace Database\Seeders;

use App\Helpers\CreateUsers;
use App\helpers\UserHelper;
use App\Helpers\video_helpers;
use App\helpers\VideoHelpers;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Video;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::truncate();
        Video::truncate();
        Role::truncate();
        Permission::truncate();

        CreateUsers::create_role_and_permissions();

        CreateUsers::create_regular_user();

        $admin = CreateUsers::create_superadmin_user();
        $admin->assignRole('super_admin');

        $manager = CreateUsers::create_video_manager_user();
        $manager->assignRole('video_manager');
        video_helpers::createFirstVideo();
        video_helpers::createSecondVideo();
        video_helpers::createThirdVideo();

        video_helpers::create_series();
    }
}
