<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TugasController extends BaseController
{
    public function index(Request $request)
    {
        try {
            $user = auth()->user();
            $tasks = Task::query()
                ->when($user->role === 'user', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->filterStatus($request->status)
                ->paginate(10);
            // return $this->successResponse(new TaskResource($tasks));
            // return response()->json($tasks);
            return $this->successResponse(TaskResource::collection($tasks));
        } catch (\Throwable $th) {
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'is_completed' => 'required|in:0,1',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => $request->is_completed ?? 0,
            'user_id' => auth()->id(),
        ]);

        return response()->json($task);
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $this->authorize('update', $task);

        $task->update($request->all());
        return response()->json($task);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $this->authorize('delete', $task);

        $task->delete();
        return response()->json(['message' => 'Task deleted']);
    }
}
