<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks, 200);
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'nullable|string',
        ]);

        $task = Task::create($request->all());
        return response()->json($task, 201);
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);


        if ($task) {
            $request->validate([
                'title' => 'required|string|max:255',
                'details' => 'nullable|string',
            ]);
            $task->update($request->all());
            return response()->json($task, 200);
        } else {
            return response()->json(['message' => 'Task not found'], 404);
        }
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        if ($task) {
            $task->delete();
            return response()->json(['message' => 'Task deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Task not found'], 404);
        }
    }
}
