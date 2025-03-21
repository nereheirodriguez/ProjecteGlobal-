<?php
namespace App\Helpers;

use App\Models\User;
use App\Models\Video;

class video_helpers
{
    public static function createFirstVideo(): Video
    {
        return Video::create([
            'title' => 'Video title',
            'description' => 'Video description',
            'url' => 'https://www.youtube.com/embed/7EjnAPp2dHk',
            'published_at' => now(),
            'next' => null,
            'series_id' => null,
            'user_id' => User::factory()->create()->id,
        ]);
    }

    public static function createSecondVideo(): Video
    {
        return Video::create([
            'title' => 'Video title',
            'description' => 'Video descripfasdpfkodsaifjgpdsaouhgpirañdjfañoaeidsjfñdsafjkdsñaoijtion',
            'url' => 'https://www.youtube.com/embed/7EjnAPp2dHk',
            'published_at' => now(),
            'next' => null,
            'series_id' => null,
            'user_id' => User::factory()->create()->id,

        ]);
    }

    public static function createThirdVideo(): Video
    {
        return Video::create([
            'title' => 'Video title',
            'description' => 'Video description',
            'url' => 'https://www.youtube.com/embed/7EjnAPp2dHk',
            'published_at' => now(),
            'next' => null,
            'series_id' => null,
            'user_id' => User::factory()->create()->id,
        ]);
    }
}
