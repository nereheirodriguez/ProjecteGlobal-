<?php

namespace Tests\Feature\Serie;

use App\Helpers\CreateUsers;
use App\Models\Serie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class SeriesManageControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userAdmin = CreateUsers::create_superadmin_user();
        Permission::findOrCreate('super_admin');
        Permission::findOrCreate('serie_manager');

        $this->userAdmin->givePermissionTo('super_admin');
        $this->userAdmin->givePermissionTo('serie_manager');

        $this->userManager = CreateUsers::create_regular_user();
        $this->userRegular = CreateUsers::create_video_manager_user();
        $this->userRegular->givePermissionTo('serie_manager');
    }

    private function loginAsSuperAdmin()
    {
        $this->actingAs($this->userAdmin);
    }

    private function loginAsVideoManager()
    {
        $this->actingAs($this->userRegular);
    }

    private function loginAsRegularUser()
    {
        $this->actingAs($this->userManager);
    }

    public function test_user_with_permissions_can_see_add_series()
    {
        $this->loginAsSuperAdmin();
        $response = $this->get(route('series.manage.create'));
        $response->assertStatus(200);
    }

    public function test_user_without_series_manage_create_cannot_see_add_series()
    {
        $this->loginAsRegularUser();
        $response = $this->get(route('series.manage.create'));
        $response->assertForbidden();
    }

    public function test_user_with_permissions_can_store_series()
    {
        $this->loginAsSuperAdmin();
        $response = $this->post(route('series.manage.store'), []);
        $response->assertStatus(302);
    }

    public function test_user_without_permissions_cannot_store_series()
    {
        $this->loginAsRegularUser();
        $response = $this->post(route('series.manage.store'), []);
        $response->assertForbidden();
    }

    public function test_user_with_permissions_can_destroy_series()
    {
        $this->loginAsSuperAdmin();
        Serie::factory()->create();
        $response = $this->delete(route('series.manage.destroy', ['id' => 1]));
        $response->assertStatus(302);
    }

    public function test_user_without_permissions_cannot_destroy_series()
    {
        $this->loginAsRegularUser();
        $response = $this->delete(route('series.manage.destroy', ['id' => 1]));
        $response->assertForbidden();
    }

    public function test_user_with_permissions_can_see_edit_series()
    {
        $this->loginAsSuperAdmin();
        Serie::factory()->create();
        $response = $this->get(route('series.manage.edit', ['id' => 1]));
        $response->assertStatus(200);
    }

    public function test_user_without_permissions_cannot_see_edit_series()
    {
        $this->loginAsRegularUser();
        $response = $this->get(route('series.manage.edit', ['id' => 1]));
        $response->assertForbidden();
    }

    public function test_user_with_permissions_can_update_series()
    {
        $this->loginAsSuperAdmin();
        $response = $this->put(route('series.manage.update', ['id' => 1]), []);
        $response->assertStatus(302);
    }

    public function test_user_without_permissions_cannot_update_series()
    {
        $this->loginAsRegularUser();
        $response = $this->put(route('series.manage.update', ['id' => 1]), []);
        $response->assertForbidden();
    }

    public function test_user_with_permissions_can_manage_series()
    {
        $this->loginAsSuperAdmin();
        $response = $this->get(route('series.manage.create'));
        $response->assertStatus(200);
    }

    public function test_regular_users_cannot_manage_series()
    {
        $this->loginAsRegularUser();
        $response = $this->get(route('series.manage.create'));
        $response->assertForbidden();
    }

    public function test_guest_users_cannot_manage_series()
    {
        $response = $this->get(route('series.manage.create'));
        $response->assertRedirect(route('login'));
    }

    public function test_videomanagers_can_manage_series()
    {
        $this->loginAsVideoManager();
        $response = $this->get(route('series.manage.create'));
        $response->assertStatus(200);
    }

    public function test_superadmins_can_manage_series()
    {
        $this->loginAsSuperAdmin();
        $response = $this->get(route('series.manage.create'));
        $response->assertStatus(200);
    }
}
