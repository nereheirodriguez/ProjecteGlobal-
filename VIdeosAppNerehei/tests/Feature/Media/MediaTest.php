<?php

namespace Tests\Feature\Media;

use App\Models\Media;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MediaTest extends TestCase
{
    use RefreshDatabase;


    public function test_it_can_list_all_multimedia()
    {
        Media::factory()->count(3)->create();
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->getJson('/api/media');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_it_can_store_a_multimedia_file()
    {
        Storage::fake('local');
        $user = User::factory()->create();
        $this->actingAs($user);
        $file = UploadedFile::fake()->image('photo.jpg');

        $response = $this->postJson('/api/media', [
            'user_id' => $user->id,
            'file' => $file,
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['id', 'path']);

        Storage::disk('local')->assertExists('Media/' . $file->hashName());
    }
    public function test_it_can_delete_a_multimedia_file()
    {
        Storage::fake('local');

        $user = User::factory()->create();
        $this->actingAs($user);

        $file = UploadedFile::fake()->image('photo.jpg');
        $path = $file->store('media', 'local');

        $multimedia = Media::factory()->create([
            'user_id' => $user->id,
            'path' => $path,
        ]);

        $response = $this->deleteJson('/api/media/' . $multimedia->id);

        $response->assertStatus(204);

        Storage::disk('local')->assertMissing($path);
        $this->assertDatabaseMissing('media', ['id' => $multimedia->id]);
    }
}
