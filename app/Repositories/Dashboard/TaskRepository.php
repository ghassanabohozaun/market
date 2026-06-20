<?php

namespace App\Repositories\Dashboard;

use App\Models\Task;

class TaskRepository
{
    public function getOne($id)
    {
        return Task::find($id);
    }

    public function getAllForAdmin($adminId)
    {
        return Task::where('admin_id', $adminId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function create(array $data)
    {
        return Task::create($data);
    }

    public function update($task, array $data)
    {
        return $task->update($data);
    }

    public function destroy($task)
    {
        return $task->delete();
    }

    public function toggleStatus($task)
    {
        $task->is_completed = !$task->is_completed;
        return $task->save();
    }
}
