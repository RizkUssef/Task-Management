<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
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
    public function showEditForm(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }
    public function update(Task $task, UpdateTaskRequest $request)
    {
        $updated = $this->task_service->update($task, $request->validated());
        return $this->respond(
            $updated,
            'Task Updated Successfully',
            'Task Update Failed',
            redirect()->route('tasks.show', $task)
        );
    }
    public function delete(Task $task)
    {
        $deleted = $this->task_service->delete($task);
        return $this->respond(
            $deleted,
            'Task Deleted Successfully',
            'Task Deletion Failed',
            redirect()->route('tasks')
        );
    }
}
