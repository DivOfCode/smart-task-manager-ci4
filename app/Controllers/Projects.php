<?php

namespace App\Controllers;
use App\Models\ProjectModel;

class Projects extends BaseController
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
        $model = new ProjectModel();
        $data['projects'] = $model->findAll();

        return view('projects/index', $data);
    }

    public function create()
    {
        return view('projects/create');
    }

    public function store()
    {
        $model = new ProjectModel();

        $model->save([
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'user_id' => session('user_id')
        ]);

        return redirect()->to('/projects')->with('success', 'Project created successfully.');
    }

    public function edit($id)
    {
        $model = new ProjectModel();
        $data['project'] = $model->find($id);

        return view('projects/edit', $data);
    }

    public function update($id)
    {
        $model = new ProjectModel();

        $model->update($id, [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ]);

        return redirect()->to('/projects')->with('success', 'Project updated.');
    }

    public function delete($id)
    {
        $model = new ProjectModel();
        $model->delete($id);

        return redirect()->to('/projects')->with('success', 'Project deleted.');
    }
}
