<?php

namespace App\Observers;

use App\Models\Task;
use Illuminate\Support\Facades\Cache;

class TaskObserver
{
    private $tenant_id;
    public function __construct()
    {
        $this->tenant_id = app('currentTenant')->id;
    }
    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        Cache::tags(["tenant:{$this->tenant_id}","user:{$task->user_id}"])->flush();
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        Cache::tags(["tenant:{$this->tenant_id}","user:{$task->user_id}"])->flush();
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        Cache::tags(["tenant:{$this->tenant_id}","user:{$task->user_id}"])->flush();
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(Task $task): void
    {
        Cache::tags(["tenant:{$this->tenant_id}","user:{$task->user_id}"])->flush();
    }
}
