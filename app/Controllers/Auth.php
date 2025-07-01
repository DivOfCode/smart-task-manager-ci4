<?php

namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function loginProcess()
    {
        $session = session();
        $model = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $model->where('email', $email)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $session->set([
                    'user_id' => $user['id'],
                    'user_name' => $user['name'],
                    'user_email' => $user['email'],
                    'role' => $user['role'],
                    'isLoggedIn' => true
                ]);
                return redirect()->to('/dashboard');
            } else {
                return redirect()->back()->with('error', 'Invalid password');
            }
        } else {
            return redirect()->back()->with('error', 'Email not found');
        }
    }

    public function register()
    {
        return view('auth/register');
    }

  public function registerProcess()
{
    $model = new \App\Models\UserModel(); 

    // $recaptchaResponse = $this->request->getVar('g-recaptcha-response');
    // $secretKey = '6LepPmorAAAAADSoxjniuE5E0WmoWWD_EPH0M6RW'; 

    // $client = \Config\Services::curlrequest();
    // $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
    //     'form_params' => [
    //         'secret'   => $secretKey,
    //         'response' => $recaptchaResponse,
    //         'remoteip' => $this->request->getIPAddress(),
    //     ]
    // ]);

    // $result = json_decode($response->getBody());

    // if (!$result->success) {
    //     return redirect()->back()->withInput()->with('error', 'reCAPTCHA validation failed. Please try again.');
    // }

    $data = [
        'name'     => $this->request->getVar('name'),
        'email'    => $this->request->getVar('email'),
        'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
    ];

    $model->insert($data);

    return redirect()->to('/login')->with('success', 'Account created. Please login.');
}


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
