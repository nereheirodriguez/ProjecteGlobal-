<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Helpers\video_helpers;
use App\Models\Video;

class HelpersTest extends TestCase
{
    public function testGetDefaultValues()
    {
        $defaultValues = video_helpers::getDefaultValues();

        $this->assertIsArray($defaultValues);
        $this->assertArrayHasKey('title', $defaultValues);
        $this->assertArrayHasKey('description', $defaultValues);
        $this->assertArrayHasKey('url', $defaultValues);
        $this->assertArrayHasKey('published_at', $defaultValues);
        $this->assertArrayHasKey('previous', $defaultValues);
        $this->assertArrayHasKey('next', $defaultValues);
        $this->assertArrayHasKey('series_id', $defaultValues);

        $this->assertEquals('Video title', $defaultValues['title']);
        $this->assertEquals('Video description', $defaultValues['description']);
        $this->assertEquals('https://www.youtube.com/embed/7EjnAPp2dHk', $defaultValues['url']);
    }

    public function testCreateVideoWithDefaultValues()
    {
        $defaultValues = video_helpers::getDefaultValues();
        $video = new Video($defaultValues);

        $this->assertEquals('Video title', $video->title);
        $this->assertEquals('Video description', $video->description);
        $this->assertEquals('https://www.youtube.com/embed/7EjnAPp2dHk', $video->url);
        $this->assertNotNull($video->published_at);
        $this->assertNull($video->previous);
        $this->assertNull($video->next);
        $this->assertNull($video->series_id);
    }
}
