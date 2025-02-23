<?php

namespace App\Http\Controllers;

use App\Models\categorie;
use App\Models\Task;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
  public function index()
{
  $tasks = Task::with('categories')->where('user_id', Auth::id()) ->get();
    return view('Task.index', compact('tasks'));
}
 
  public function create(Request $request,Task $task)
  {
    if ($request->isMethod('post')) {
      $user = Auth::user();

      $validatedData = $request->validate([
          'name' => ['required', 'between:5,50'],
          'due_date' => ['required', 'date'],
          'categorie_id' => ['required', 'array'],
          'Priority' => ['required'],
      ]);
      
        $task = $user->task()->create([
          'name' => $validatedData['name'],
          'due_date' => $validatedData['due_date'],
          'Priority' => $validatedData['Priority'],
        ]);

        $task->categories()->attach($validatedData['categorie_id']);

      
      
        return redirect()->route("task.index");
      
  }
  
      else if($request->isMethod("get")){
        $categories = DB::table('categories')->select('id', 'name')->get();
        return view("Task.Create",['categories'=>$categories]);
      }
  }
  public function edit(Request $request, $id = null)
{
    $user = Auth::user();

    if ($request->isMethod('post')) {
     
        $validatedData = $request->validate([
            'name' => ['required', 'between:5,10'],
            'due_date' => ['date', 'required'],
            'categorie' => ['required', 'array'], 
            'Priority' => ['required'],
        ]);

      
        $task = $user->task()->find($request->task_id);

        if ($task) {
            $task->update([
                'name' => $validatedData['name'],
                'due_date' => $validatedData['due_date'],
                'Priority' => $validatedData['Priority'],
            ]);
            $task->categories()->sync($validatedData['categorie']);
        }

        return redirect()->route('task.index')->with('success', 'Task updated successfully!');
    }

    
    if ($request->isMethod('get')) {
        $task = $user->task()->with('categories')->findOrFail($id); 
        $categories = DB::table('categories')->select('id', 'name')->get();

        return view("Task.Edit", [
            "task" => $task,
            "categories" => $categories
        ]);
    }
}
  public function delete(Request $request){
    $user = Auth::user();

    $request->validate([
        'task_id' => ['required', 'exists:tasks,id'],
    ]);

    $task = $user->tasks()->find($request->task_id);

    if ($task) {
        $task->categories()->detach();
        $task->delete();
    }
  }  
}
