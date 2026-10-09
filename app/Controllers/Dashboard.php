<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $today = date('Y-m-d');
        $taskModel = new TaskModel();
        $tasks = $taskModel
            ->where('task_date', $today)
            ->where('is_archived', 0)
            ->orderBy('task_date', 'ASC')
            ->orderBy('id', 'ASC')
            ->findAll();

        return view('pages/welcome', [
            'tasks' => $tasks,
            'today' => $today,
        ]);
    }
}
