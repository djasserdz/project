<?php

namespace App\Services;

use App\Events\TaskCreateEvent;
use App\repositories\TaskRepo;
use Illuminate\Support\Facades\DB;

class TaskService
{
    public static function create(array $data, $user_id)
    {
        return DB::transaction(function () use ($data, $user_id) {
            $data['user_id'] = $user_id;
            $task = TaskRepo::create($data);
            event(new TaskCreateEvent($task));

            return $task;
        }, 2);

    }

    public static function search($id)
    {
        return TaskRepo::find_id($id);
    }

    public static function get_by_user($user_id)
    {
        return TaskRepo::get_by_user($user_id);
    }
}
