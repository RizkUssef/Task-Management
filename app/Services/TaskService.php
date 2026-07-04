<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TaskService
{
    // protected function taskCacheVersion(int $user_id): int
    // {
    //     return Cache::get("tasks:version:{$user_id}", 1);
    // }
    public function all(Request $request)
    {
        $tenant_id = app('currentTenant')->id;
        $user_id = auth()->id();
        $page = $request->get('page', 1);
        $search = $request->get('search', '');
        $status = $request->get('status', '');
        $cache_key = "tasks:tenant:{$tenant_id}:user:{$user_id}:page:{$page}:search:{$search}:status:{$status}";
        
        $cached = Cache::tags(["tenant:{$tenant_id}", "user:{$user_id}"])
            ->remember($cache_key, now()->addMinutes(10), function () use ($request) {
                $paginator = auth()->user()->tasks()
                    ->when($request->filled('search'), function ($query) use ($request) {
                        $query->where('title', 'like', '%' . $request->search . '%');
                    })
                    ->when($request->filled('status'), function ($query) use ($request) {
                        $query->where('status', $request->status);
                    })
                    ->latest()
                    ->paginate(10);

                return [
                    'items' => $paginator->getCollection()->toArray(),
                    'total' => $paginator->total(),
                    'per_page' => $paginator->perPage(),
                    'current_page' => $paginator->currentPage(),
                ];
            });

        $items = Task::hydrate($cached['items']);

        return new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $cached['total'],
            $cached['per_page'],
            $cached['current_page'],
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );
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
