<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
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
