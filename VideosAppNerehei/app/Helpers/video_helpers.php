<?php
namespace App\Helpers;

use App\Models\Serie;
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
            'serie_id' => null,
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
            'serie_id' => null,
            'user_id' => User::factory()->create()->id,

        ]);
    }

    public static function createThirdVideo(): Video
    {
        return Video::create([
            'title' => 'Video title',
            'description' => 'Video description',
            'url' => 'https://images.steamusercontent.com/ugc/2053129740384007681/008613159A03A2D9A1A38C0F66FC3F3CBCF73C9C/?imw=637&imh=358&ima=fit&impolicy=Letterbox&imcolor=%23000000&letterbox=true',
            'published_at' => now(),
            'next' => null,
            'serie_id' => null,
            'user_id' => User::factory()->create()->id,
        ]);
    }
    public static function create_series()
    {
        Serie::create([
            'title' => 'Series 1',
            'description' => 'Description for series 1',
            'image' => 'https://images.steamusercontent.com/ugc/2053129740384007681/008613159A03A2D9A1A38C0F66FC3F3CBCF73C9C/?imw=637&imh=358&ima=fit&impolicy=Letterbox&imcolor=%23000000&letterbox=true',
            'user_id' => User::factory()->create()->id,
        ]);

        Serie::create([
            'title' => 'Series 2',
            'description' => 'Description for series 2',
            'image' => 'https://images.steamusercontent.com/ugc/2053129740384007681/008613159A03A2D9A1A38C0F66FC3F3CBCF73C9C/?imw=637&imh=358&ima=fit&impolicy=Letterbox&imcolor=%23000000&letterbox=true',
            'user_id' => User::factory()->create()->id,
        ]);

        Serie::create([
            'title' => 'Series 3',
            'description' => 'Description for series 3',
            'image' => 'https://example.com/image3.jpg',
            'user_id' => User::factory()->create()->id,
        ]);
    }


}
