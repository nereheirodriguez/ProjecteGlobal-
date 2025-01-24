<?php

namespace App\Helpers;
use App\Models\Video;

class video_helpers
{
    public static function getDefaultValues()
    {
        return [
            'title' => 'Video title',
            'description' => 'Video description',
            'url' => 'https://www.youtube.com/embed/7EjnAPp2dHk',
            'published_at' => now(),
            'previous' => null,
            'next' => null,
            'series_id' => null,
        ];
    }
}
