<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\TaskRepository;

class TaskService
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getTasksForAdmin($adminId)
    {
        return $this->taskRepository->getAllForAdmin($adminId);
    }

    public function createTask(array $data)
    {
        return $this->taskRepository->create($data);
    }

    public function updateTask($id, array $data)
    {
        $task = $this->taskRepository->getOne($id);
        if ($task) {
            return $this->taskRepository->update($task, $data);
        }
        return false;
    }

    public function deleteTask($id)
    {
        $task = $this->taskRepository->getOne($id);
        if ($task) {
            return $this->taskRepository->destroy($task);
        }
        return false;
    }

    public function toggleTaskStatus($id)
    {
        $task = $this->taskRepository->getOne($id);
        if ($task) {
            return $this->taskRepository->toggleStatus($task);
        }
        return false;
    }
}
