<?php

namespace Tests\Feature\Videos;

use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Events\VideoCreated;
use App\Notifications\VideoCreatedNotification;

class VideoNotificationsTest extends TestCase
{
    public function test_video_created_event_is_dispatched()
    {
        Event::fake();

        $user = User::factory()->create();
        $this->actingAs($user);

        $videoData = [
            'title' => 'Test Video',
            'description' => 'Test Description',
            'url' => 'http://example.com/video.mp4',
            'serie_id' => 1,
        ];

        $this->postJson('/api/videos', $videoData);

        Event::assertDispatched(VideoCreated::class, function ($event) use ($videoData) {
            return $event->video->title === $videoData['title'];
        });
    }

    public function test_push_notification_is_sent_when_video_is_created()
    {
        Notification::fake();

        $user = User::factory()->create();
        $this->actingAs($user);

        $videoData = [
            'title' => 'Test Video',
            'description' => 'Test Description',
            'url' => 'http://example.com/video.mp4',
            'serie_id' => 1,
        ];

        $this->postJson('/api/videos', $videoData);

        Notification::assertSentTo(
            [$user],
            VideoCreatedNotification::class,
            function ($notification, $channels) use ($videoData) {
                return $notification->video->title === $videoData['title'];
            }
        );
    }
}
