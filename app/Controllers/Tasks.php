<?php

namespace App\Controllers;
use App\Models\TaskModel;
use App\Models\ProjectModel;
use App\Models\UserModel;

class Tasks extends BaseController
{   

   public function __construct()
   {
    parent::__construct();
    helper('url'); 

    if (!session()->get('isLoggedIn')) {
        redirect()->to('/login')->send(); 
        exit();
    }
}
public function index()
{
    $taskModel = new TaskModel();
    $data['tasks'] = $taskModel
    ->select('tasks.*, projects.name AS project_name, users.name AS assigned_name')
    ->join('projects', 'projects.id = tasks.project_id', 'left')
    ->join('users', 'users.id = tasks.assigned_to', 'left')
    ->orderBy('deadline', 'ASC')
    ->findAll();

    return view('tasks/index', $data);
}

public function create()
{
    $data['projects'] = (new ProjectModel())->findAll();
    $data['users'] = (new UserModel())->findAll();
    return view('tasks/create', $data);
}

public function store()
{
    $taskModel = new TaskModel();

    $taskModel->save([
        'title' => $this->request->getPost('title'),
        'description' => $this->request->getPost('description'),
        'priority' => $this->request->getPost('priority'),
        'status' => $this->request->getPost('status'),
        'deadline' => $this->request->getPost('deadline'),
        'project_id' => $this->request->getPost('project_id'),
        'assigned_to' => $this->request->getPost('assigned_to'),
    ]);

    return redirect()->to('/tasks')->with('success', 'Task created successfully.');
}

public function edit($id)
{
    $taskModel = new TaskModel();
    $data['task'] = $taskModel->find($id);
    $data['projects'] = (new ProjectModel())->findAll();
    $data['users'] = (new UserModel())->findAll();
    return view('tasks/edit', $data);
}

public function update($id)
{
    $taskModel = new TaskModel();

    $taskModel->update($id, [
        'title' => $this->request->getPost('title'),
        'description' => $this->request->getPost('description'),
        'priority' => $this->request->getPost('priority'),
        'status' => $this->request->getPost('status'),
        'deadline' => $this->request->getPost('deadline'),
        'project_id' => $this->request->getPost('project_id'),
        'assigned_to' => $this->request->getPost('assigned_to'),
    ]);

    return redirect()->to('/tasks')->with('success', 'Task updated.');
}

public function delete($id)
{
    (new TaskModel())->delete($id);
    return redirect()->to('/tasks')->with('success', 'Task deleted.');
}
}
