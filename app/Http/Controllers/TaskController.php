<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Http\Requests\CreateTaskRequest;
use App\Traits\RespondsWithFlash;
use App\Models\Task;

class TaskController extends Controller
{
    use RespondsWithFlash;
    public function __construct(public TaskService $task_service) {}
    public function allTasks()
    {
        $tasks = auth()->user()->tasks()
            ->latest()
            ->paginate(10);

        return view('tasks.all-tasks', compact('tasks'));
    }
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }
    public function showCreateForm()
    {
        return view('tasks.create');
    }
    public function create(CreateTaskRequest $request)
    {
        $created = $this->task_service->create($request->validated());
        return $this->respond(
            $created,
            'Task Created Successfully',
            'Task Creation Failed',
            redirect()->route('tasks')
        );
    }
}
