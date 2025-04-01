<?php

namespace Tests\Feature\Videos;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Video;

class VideosTest extends TestCase
{
    use RefreshDatabase;

    public function testUsersCanViewVideos()
    {
        $video = Video::factory()->create();

        $response = $this->get(route('videos.show', $video->id));

        $response->assertStatus(200);
        $response->assertSee($video->title);
        $response->assertSee($video->description);
        $response->assertSee($video->url);
    }

    public function testUsersCannotViewNotExistingVideos()
    {
        $response = $this->get(route('videos.show', 999));

        $response->assertStatus(404);
    }
}

























