<?php

namespace App\Listeners;

use App\Events\TaskCreateEvent;
use App\Mail\TaskNotificationEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class CreateTaskListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */

    /**
     * Handle the event.
     */
    public function handle(TaskCreateEvent $event): void
    {
        $task = $event->task;
        $user = $task->user;

        Mail::to($user->email)->queue(new TaskNotificationEmail($task));
    }
}
