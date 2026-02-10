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

            DB::afterCommit(function () use ($task) {
                CacheService::put('task:', $task->id, [
                    'id' => $task->id,
                    'name' => $task->name,
                    'description' => $task->description,
                    'priority' => $task->priority,
                    'user_id' => $task->user_id,
                    'created_at' => $task->created_at,
                ], 600);

                event(new TaskCreateEvent($task));
            });

            return $task;
        }, 2);
    }

    public static function search($id)
    {
        $cached = CacheService::get('task:', $id);
        if ($cached) {
            return $cached;
        }

        $task = TaskRepo::find_id($id);

        if ($task) {
            CacheService::put('task:', $task->id, $task->toArray(), 600);
        }

        return $task;
    }

    public static function get_by_user($user_id)
    {
        return TaskRepo::get_by_user($user_id);
    }

    /*public static function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $task = TaskRepo::update($id, $data);

            DB::afterCommit(function () use ($task) {
                CacheService::put('task:', $task->id, $task->toArray(), 600);
            });

            return $task;
        });
    }

    public static function delete($id)
    {
        return DB::transaction(function () use ($id) {
            $deleted = TaskRepo::delete($id);

            DB::afterCommit(function () use ($id) {
                CacheService::forget('task:', $id);
            });

            return $deleted;
        });
    }*/
}
