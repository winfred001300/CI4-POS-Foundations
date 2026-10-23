<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Tasks extends BaseController
{
    public function index()
    {
        $taskModel = new TaskModel();

        $data['tasks'] = $taskModel
            ->where('is_archived', 0)
            ->orderBy('task_date', 'ASC')
            ->findAll();

        return view('tasks/index', $data);
    }

    public function new()
    {
        return view('tasks/new');
    }

    public function create()
    {
        $rules = [
            'title'     => 'required|max_length[150]',
            'task_date' => 'required|valid_date[Y-m-d]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->to(site_url('tasks/new'))
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $taskModel = new TaskModel();

        $taskModel->insert([
            'title'       => trim((string) $this->request->getPost('title')),
            'description' => trim((string) $this->request->getPost('description')),
            'task_date'   => $this->request->getPost('task_date'),
            'is_archived' => 0,
        ]);

        return redirect()->to(site_url('tasks'))
            ->with('success', 'Task created successfully.');
    }

    public function edit($id)
    {
        $taskModel = new TaskModel();
        $task = $taskModel->find($id);

        if (! $task || $task['is_archived']) {
            return redirect()->to(site_url('tasks'))
                ->with('error', 'Task not found or already archived.');
        }

        return view('tasks/edit', ['task' => $task]);
    }

    public function update($id)
    {
        $taskModel = new TaskModel();
        $task = $taskModel->find($id);

        if (! $task || $task['is_archived']) {
            return redirect()->to(site_url('tasks'))
                ->with('error', 'Task not found or already archived.');
        }

        $rules = [
            'title'     => 'required|max_length[150]',
            'task_date' => 'required|valid_date[Y-m-d]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->to(site_url('tasks/edit/' . $id))
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $taskModel->update($id, [
            'title'       => trim((string) $this->request->getPost('title')),
            'description' => trim((string) $this->request->getPost('description')),
            'task_date'   => $this->request->getPost('task_date'),
        ]);

        return redirect()->to(site_url('tasks'))
            ->with('success', 'Task updated successfully.');
    }

    // Archive a task without permanently deleting it
    public function archive($id)
    {
        $taskModel = new TaskModel();
        $task = $taskModel->find($id);

        if (! $task || (int) $task['is_archived'] === 1) {
            return redirect()->to(site_url('tasks'))
                ->with('error', 'Task not found or already archived.');
        }

        $taskModel->update($id, [
            'is_archived' => 1,
        ]);

        return redirect()->to(site_url('tasks'))
            ->with('success', 'Task archived successfully.');
    }
}
