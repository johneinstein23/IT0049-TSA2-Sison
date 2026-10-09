<?php

namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Tasks extends BaseController
{
    public function index(): string
    {
        $taskModel = new TaskModel();
        $tasks = $taskModel
            ->where('is_archived', 0)
            ->orderBy('task_date', 'ASC')
            ->orderBy('id', 'ASC')
            ->findAll();

        return view('pages/tasks', ['tasks' => $tasks]);
    }

    public function newTask(): string
    {
        return view('pages/task_form', [
            'title' => 'New Task',
            'task' => ['title' => '', 'status' => 'pending', 'task_date' => date('Y-m-d')],
            'action' => site_url('tasks'),
            'submitLabel' => 'Create task',
        ]);
    }

    public function create()
    {
        if (! $this->validate($this->taskRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        (new TaskModel())->insert([
            'title' => trim((string) $this->request->getPost('title')),
            'status' => $this->request->getPost('status'),
            'task_date' => $this->request->getPost('task_date'),
            'is_archived' => 0,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(site_url('tasks'))->with('success', 'Task created successfully.');
    }

    public function edit(int $id): string
    {
        $task = (new TaskModel())->where('is_archived', 0)->find($id);
        if ($task === null) {
            throw new PageNotFoundException('Task not found.');
        }

        return view('pages/task_form', [
            'title' => 'Edit Task',
            'task' => $task,
            'action' => site_url("tasks/{$id}/edit"),
            'submitLabel' => 'Save changes',
        ]);
    }

    public function update(int $id)
    {
        $model = new TaskModel();
        if ($model->where('is_archived', 0)->find($id) === null) {
            throw new PageNotFoundException('Task not found.');
        }

        if (! $this->validate($this->taskRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model->update($id, [
            'title' => trim((string) $this->request->getPost('title')),
            'status' => $this->request->getPost('status'),
            'task_date' => $this->request->getPost('task_date'),
        ]);

        return redirect()->to(site_url('tasks'))->with('success', 'Task updated successfully.');
    }

    public function archive(int $id)
    {
        $model = new TaskModel();
        if ($model->where('is_archived', 0)->find($id) === null) {
            throw new PageNotFoundException('Task not found.');
        }

        $model->update($id, ['is_archived' => 1]);
        return redirect()->to(site_url('tasks'))->with('success', 'Task archived. It was not permanently deleted.');
    }

    private function taskRules(): array
    {
        return [
            'title' => 'required|max_length[150]',
            'task_date' => 'required|valid_date[Y-m-d]',
            'status' => 'required|in_list[pending,in_progress,completed]',
        ];
    }
}
