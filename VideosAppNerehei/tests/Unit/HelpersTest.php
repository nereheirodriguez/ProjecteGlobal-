<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Helpers\video_helpers;
use App\Models\Video;

class HelpersTest extends TestCase
{
    use RefreshDatabase;

    public function testGetDefaultValues()
    {
        $videos = video_helpers::createFirstVideo();

        $this->assertEquals('Video title', $videos->title);
        $this->assertEquals('Video description', $videos->description);
        $this->assertEquals('https://www.youtube.com/embed/7EjnAPp2dHk', $videos->url);
    }

    public function testCreateVideoWithDefaultValues()
    {
        $defaultValues = video_helpers::createFirstVideo();
        $this->assertEquals('Video title', $defaultValues->title);
        $this->assertEquals('Video description', $defaultValues->description);
        $this->assertEquals('https://www.youtube.com/embed/7EjnAPp2dHk', $defaultValues->url);
        $this->assertNotNull($defaultValues->published_at);
        $this->assertNull($defaultValues->previous);
        $this->assertNull($defaultValues->next);
        $this->assertNull($defaultValues->series_id);
    }
}
