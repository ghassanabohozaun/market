<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TasksController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        $title = __('dashboard.tasks');
        return view('dashboard.tasks.index', compact('title'));
    }
}
