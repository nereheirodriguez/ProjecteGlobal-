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

        // Create roles
        Permission::firstOrCreate(['name' => 'video_manager']);
        Permission::firstOrCreate(['name' => 'super_admin']);

        $videoDefault = video_helpers::createFirstVideo();
    }

    //DOCUMENTAR PUNTS 13 I 14

    use RefreshDatabase;
//DOCUMENTAR PUNT 11
    public function test_user_with_permissions_can_manage_videos()
    {
        // Crea un usuario con permisos para gestionar videos
        $user = CreateUsers::create_video_manager_user();
        $user->givePermissionTo("video_manager");
        $this->actingAs($user);
        $response = $this->get(route('manage.index'));

        $response->assertStatus(200);
        $response->assertViewIs('videos.manage.index');
    }

    public function test_regular_users_cannot_manage_videos()
    {
        $user = CreateUsers::create_regular_user();

        $response = $this->actingAs($user)->get(route('manage.index'));
        $response->assertStatus(403);
    }

    public function test_guest_users_cannot_manage_videos()
    {
        $response = $this->get(route('manage.index'));
        $response->assertRedirect('/login');
    }

    public function test_superadmins_can_manage_videos()
    {
        $user = CreateUsers::create_superadmin_user();

        $user->givePermissionTo('super_admin');
        $user->givePermissionTo('video_manager');

        $this->actingAs($user);

        $response = $this->get(route('manage.index'));

        $response->assertStatus(200);
    }


    public function test_login_as_video_manager()
    {
        $user = CreateUsers::create_video_manager_user();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => "123456789",
        ]);
        $response->assertStatus(302);
    }

    public function test_loginAsSuperAdmin()
    {
        $user = CreateUsers::create_superadmin_user();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => "123456789",
        ]);
        $response->assertStatus(302);
    }

    public function test_loginAsRegularUser()
    {
        $user = CreateUsers::create_regular_user();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => "123456789",
        ]);
        $response->assertStatus(302);
    }


    public function test_user_with_permissions_can_see_add_videos()
    {
        $user = CreateUsers::create_video_manager_user();
        $user->givePermissionTo('video_manager');
        $this->actingAs($user);

        $response = $this->get(route('manage.create'));

        $response->assertStatus(200);
    }
    public function test_user_without_videos_manage_create_cannot_see_add_videos()
    {
        $user = CreateUsers::create_regular_user();
        $this->actingAs($user);

        $response = $this->get(route('manage.create'));

        $response->assertStatus(403);
    }
    public function test_user_with_permissions_can_store_videos()
    {
        $user = CreateUsers::create_video_manager_user();
        $user->givePermissionTo('video_manager');
        $this->actingAs($user);

        $response = $this->post(route('manage.store'), [
            'title' => 'Test Video',
            'description' => 'Test Description',
            'url' => 'http://example.com/pietroscora.com',
        ]);

        $response->assertStatus(302);
    }

    public function test_user_without_permissions_cannot_store_videos()
    {
        $user = CreateUsers::create_regular_user();
        $this->actingAs($user);

        $response = $this->post(route('manage.store'), [
            'title' => 'Test Video',
            'description' => 'Test Description',
        ]);

        $response->assertStatus(403);
    }

    public function test_user_with_permissions_can_destroy_videos()
    {
        $user = CreateUsers::create_video_manager_user();
        $user->givePermissionTo('video_manager');
        $this->actingAs($user);

        $video = video_helpers::createFirstVideo();

        $response = $this->delete(route('manage.destroy', $video->id));

        $response->assertStatus(302);
    }

    public function test_user_without_permissions_cannot_destroy_videos()
    {
        $user = CreateUsers::create_regular_user();
        $this->actingAs($user);

        $video = video_helpers::createFirstVideo();

        $response = $this->delete(route('manage.destroy', $video->id));

        $response->assertStatus(403);
    }

    public function test_user_with_permissions_can_see_edit_videos()
    {
        $user = CreateUsers::create_video_manager_user();
        $user->givePermissionTo('video_manager');
        $this->actingAs($user);

        $video = video_helpers::createFirstVideo();

        $response = $this->get(route('manage.edit', $video->id));

        $response->assertStatus(200);
    }

    public function test_user_without_permissions_cannot_see_edit_videos()
    {
        $user = CreateUsers::create_regular_user();
        $this->actingAs($user);

        $video = video_helpers::createFirstVideo();

        $response = $this->get(route('manage.edit', $video->id));

        $response->assertStatus(403);
    }

    public function test_user_with_permissions_can_update_videos()
    {
        $user = CreateUsers::create_video_manager_user();
        $user->givePermissionTo('video_manager');
        $this->actingAs($user);

        $video = video_helpers::createFirstVideo();

        $response = $this->put(route('manage.update', $video->id), [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'thumbnail_url' => 'http://example.com/updated_thumbnail.jpg',
        ]);

        $response->assertStatus(302);
    }

    public function test_user_without_permissions_cannot_update_videos()
    {
        $user = CreateUsers::create_regular_user();
        $this->actingAs($user);

        $video = video_helpers::createFirstVideo();

        $response = $this->put(route('manage.update', $video->id), [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'thumbnail_url' => 'http://example.com/updated_thumbnail.jpg',
        ]);

        $response->assertStatus(403);
    }
}
