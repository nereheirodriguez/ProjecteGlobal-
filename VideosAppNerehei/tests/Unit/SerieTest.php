<?php
use App\Models\Serie;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SerieTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function serie_have_videos()
    {
        // Create a series
        $serie = Serie::factory()->create();

        // Create videos related to the series
        $videos = Video::factory()->count(3)->create(['serie_id' => $serie->id]);

        // Assert that the series has videos
        $this->assertCount(3, $serie->videos);
        $this->assertTrue($serie->videos->contains($videos->first()));
    }
}
