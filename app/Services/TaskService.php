<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskService
{
    public function all(Request $request)
    {
        $tasks = auth()->user()->tasks()
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%');
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
        return $tasks;
    }
    public function create($data)
    {
        $tenant_id = app('currentTenant')->id;
        $data['tenant_id'] = $tenant_id;
        $data['user_id'] = auth()->user()->id;
        return Task::create($data);
    }
    public function update(Task $task, $data)
    {
        return $task->update($data);
    }
    public function delete(Task $task)
    {
        return $task->delete();
    }
}
