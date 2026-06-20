<?php

namespace App\Livewire\Tasks;

use App\Services\Dashboard\TaskService;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class TodoList extends Component
{
    public $newTaskTitle = '';

    protected $taskService;

    public function boot(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function addTask()
    {
        $adminId = Auth::guard('admin')->id();

        if (!$adminId) {
            flash()->error(__('You must be logged in as an admin.'));
            return;
        }

        $this->validate([
            'newTaskTitle' => 'required|min:3|max:255',
        ]);

        $this->taskService->createTask([
            'admin_id' => $adminId,
            'title' => $this->newTaskTitle,
            'is_completed' => false,
        ]);

        $this->newTaskTitle = '';
        flash()->success(__('general.add_success_message'));
    }

    public function toggleTask($taskId)
    {
        $this->taskService->toggleTaskStatus($taskId);
    }

    public function deleteTask($taskId)
    {
        $this->taskService->deleteTask($taskId);
        flash()->success(__('general.delete_success_message'));
    }

    public function render()
    {
        $tasks = $this->taskService->getTasksForAdmin(Auth::guard('admin')->id());

        return view('livewire.tasks.todo-list', [
            'tasks' => $tasks
        ]);
    }
}
