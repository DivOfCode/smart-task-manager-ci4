<?php
namespace App\Controllers;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();

        if (!session()->get('isAdmin')) {
            return redirect()->to('/dashboard');
        }
    }

    public function index()
    {
        $data['users'] = $this->userModel->findAll();
        return view('users/index', $data);
    }

    public function toggleStatus($id)
    {
        $user = $this->userModel->find($id);
        if ($user) {
            $newStatus = $user['status'] == 'active' ? 'inactive' : 'active';
            $this->userModel->update($id, ['status' => $newStatus]);
        }
        return redirect()->back();
    }

    public function changeRole($id)
    {
        $newRole = $this->request->getPost('role');
        $this->userModel->update($id, ['role' => $newRole]);
        return redirect()->back();
    }

    public function delete($id)
{
    if (session('role') !== 'admin') {
        return redirect()->back()->with('error', 'Unauthorized');
    }

    $this->userModel->delete($id); // Soft delete
    return redirect()->back()->with('success', 'User deleted');
}

}
