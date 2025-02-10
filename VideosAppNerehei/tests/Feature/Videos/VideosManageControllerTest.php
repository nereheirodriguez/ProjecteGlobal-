<?php

namespace Tests\Feature\Videos;

use App\Helpers\CreateUsers;
use App\Helpers\video_helpers;
use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class VideosManageControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create roles and permissions
        Permission::firstOrCreate(['name' => 'manage videos']);
        Role::firstOrCreate(['name' => 'video-manager'])->givePermissionTo('manage videos');
        Role::firstOrCreate(['name' => 'super-admin'])->givePermissionTo('manage videos');

        // Create a default video
        Video::factory()->create(['id' => 1]);
    }

    /** @test */
    public function user_with_permissions_can_manage_videos()
    {
       // $user = User::factory()->create();
        $user = CreateUsers::create_video_manager_user();
        $user->assignRole('video-manager');

        $this->actingAs($user);
        $response = $this->get(route('videos.index'));

        $response->assertStatus(200);
        $response->assertViewIs('videos.index');
    }

    /** @test */
    public function regular_users_cannot_manage_videos()
    {
        $user = CreateUsers::create_regular_user();

        $response = $this->actingAs($user)->get(route('videos.index'));
        $response->assertStatus(403);
    }

    /** @test */
    public function guest_users_cannot_manage_videos()
    {
        $response = $this->get(route('videos.index'));
        $response->assertRedirect('/login');
    }

    /** @test */
    public function superadmins_can_manage_videos()
    {
        $user = CreateUsers::create_superadmin_user();

        $this->actingAs($user);
        $response = $this->get(route('videos.index'));

        $response->assertStatus(200);
    }

    /** @test */
    public function loginAsVideoManager()
    {
        $user = CreateUsers::create_video_manager_user();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => "123456789",
        ]);
        $response->assertStatus(302);
    }

    /** @test */
    public function loginAsSuperAdmin()
    {
        $user = CreateUsers::create_superadmin_user();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => "123456789",
        ]);
        $response->assertStatus(302);
    }

    /** @test */
    public function loginAsRegularUser()
    {
        $user = CreateUsers::create_regular_user();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => "123456789",
        ]);
        $response->assertStatus(302);
    }
}
