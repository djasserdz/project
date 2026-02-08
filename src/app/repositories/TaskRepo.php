<?php

namespace App\repositories;

use App\Models\Task;
use Exception;
use Illuminate\Database\QueryException;

class TaskRepo
{
    public static function create(array $data)
    {
        try {
            return Task::create($data);
        } catch (QueryException $e) {
            throw new Exception('database error : '.$e->getMessage());
        }
    }

    public static function find_id($id)
    {
        try {
            return Task::where(column: 'id', operator: $id)->first();
        } catch (QueryException $e) {
            throw new Exception('databases error : '.$e->getMessage());
        }
    }

    public static function get_by_user($user_id)
    {
        try {
            return Task::where('user_id', $user_id)->paginate(10);
        } catch (QueryException $e) {
            throw new Exception('databse error : '.$e->getMessage());
        }
    }
}
