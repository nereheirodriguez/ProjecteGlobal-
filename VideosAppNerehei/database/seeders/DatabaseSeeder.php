<?php

namespace Database\Seeders;

use App\Helpers\video_helpers;
use Illuminate\Database\Seeder;
use App\Helpers\CreateUsers;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Example user data
        $user = [
            'name' => 'Default User',
            'email' => 'a@example.com',
            'password' => 'password', // Ensure this meets the validation requirements
        ];

        // Call the method with the user data
        CreateUsers::creacioUsuariDefecte($user);
        video_helpers::getDefaultValues();
    }
}
