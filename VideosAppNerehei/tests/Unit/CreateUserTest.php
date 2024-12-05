<?php

namespace Tests\Unit;

use App\Helpers\CreateUsers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    public function testCreacioUsuariDefecte()
    {
        $user = (new CreateUsers)->creacioUsuariDefecte([
            'name' => 'UserDefault',
            'email' => 'user@example.com',
            'password' => 'Nerehei1234',
        ]);

        $this->assertEquals('UserDefault', $user->name);
        $this->assertEquals('user@example.com', $user->email);
        $this->assertTrue(\Hash::check('Nerehei1234', $user->password));
        $this->assertCount(1, $user->ownedTeams);
    }

    public function testCreacioProfessorDefecte()
    {
        $user = (new CreateUsers)->creacioUsuariDefecte([
            'name' => 'ProfessorDefault',
            'email' => 'professor@example.com',
            'password' => 'Nerehei1234',
        ]);

        $this->assertEquals('ProfessorDefault', $user->name);
        $this->assertEquals('professor@example.com', $user->email);
        $this->assertTrue(\Hash::check('Nerehei1234', $user->password));
        $this->assertCount(1, $user->ownedTeams);
    }
}
