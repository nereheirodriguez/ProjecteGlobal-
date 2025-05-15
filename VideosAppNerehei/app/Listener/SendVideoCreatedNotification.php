<?php

namespace App\Listener;

use App\Events\VideoEvent;
use App\Mail\VideoMail;
use App\Models\User;
use App\Notifications\VideoCreatedNotification;
use Illuminate\Support\Facades\Mail;

class SendVideoCreatedNotification
{
    public function handle(VideoEvent $event)
    {
        $admins = User::role('super_admin')->get();

       # Mail::to("nereheirodriguez@iesebre.com")->send(new VideoMail($event->video));

        foreach ($admins as $admin) {
            if (!$admin->notifications()->where('data->video_id', $event->video->id)->exists()) {
                $admin->notify(new VideoCreatedNotification($event->video));
            }
        }
    }
}
