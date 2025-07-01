<?php

namespace App\Controllers;
use App\Models\ProjectModel;
use App\Models\TaskModel;
use App\Models\UserModel;

class Dashboard extends BaseController
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
        $projectModel = new ProjectModel();
        $taskModel = new TaskModel();
        $userModel = new UserModel();

        $data['totalProjects'] = $projectModel->countAll();
        $data['totalTasks'] = $taskModel->countAll();
        $data['completedTasks'] = $taskModel->where('status', 'done')->countAllResults();
        $data['pendingTasks'] = $taskModel->where('status', 'pending')->countAllResults();
        $data['inProgressTasks'] = $taskModel->where('status', 'in_progress')->countAllResults();

        // Optional: Upcoming tasks (deadline within next 7 days)
        $data['upcomingTasks'] = $taskModel
        ->where('deadline >=', date('Y-m-d'))
        ->where('deadline <=', date('Y-m-d', strtotime('+7 days')))
        ->findAll();

        $data['myProjects'] = $projectModel
        ->where('user_id', session('user_id'))
        ->orderBy('created_at', 'DESC')
        ->findAll();

        $data['allTasks'] = $taskModel->findAll();
        $data['users'] = $userModel->findAll();

        return view('dashboard/index', $data);
    }
}
