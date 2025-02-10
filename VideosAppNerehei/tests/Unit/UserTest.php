<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function isSuperAdmin()
    {
        $superAdmin = User::factory()->create(['super_admin' => true]);
        $regularUser = User::factory()->create(['super_admin' => false]);

        $this->assertTrue($superAdmin->isSuperAdmin());
        $this->assertFalse($regularUser->isSuperAdmin());
    }
}
