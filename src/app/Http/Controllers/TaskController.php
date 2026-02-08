<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTask;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    public function create(CreateTask $request){
        $user=$request->user();
        $task = TaskService::create($request->validated(),$user->id);
        return response()->json([
            "task"=>new TaskResource($task)
        ],Response::HTTP_CREATED);
    }
    public function search($id){
        $task = TaskService::search($id);
        if(!$task){
            return response()->json([
                "message"=>"Task not found"
            ],Response::HTTP_NOT_FOUND);
        }
        return response()->json([
            "task"=>new TaskResource($task)
        ],Response::HTTP_OK);
    }
    public function user_tasks(Request $request){
        $user= $request->user();
        $tasks=TaskService::get_by_user($user->id);
        if(!$tasks){
            return response()->json([
                "message"=>"You have no tasks"
            ],Response::HTTP_NOT_FOUND);
        }
        return response()->json([
            "tasks"=> TaskResource::collection($tasks)
        ],Response::HTTP_OK);

    }
}
