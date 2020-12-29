<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Ver todas las tareas
    public function index()
    {
        return Task::where('user_id', auth()->user()->id)->get();
    }
   
    // Registrar las tareas
    public function store(Request $request)
    {
        $task = Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'content' => $request->content,
            'user_id' => auth()->id()
        ]);        
    }

    // Ver tarea
    public function show(Task $task, $id)
    {
        $task = Task::find($id);
        return $task;
    }

    // Actualizar Tareas
    public function update(Request $request, Task $task)
    {
        $task = Task::findOrFail($request->id);
        $task->name = $request->name;
        $task->description = $request->description;
        $task->content = $request->content;
        $task->save();
        return $task;
    }

    // Eliminar tarea
    public function destroy(Task $task, $id)
    {
        $task = Task::find($id);
        $task->delete(); 
        return $task;
    }
}