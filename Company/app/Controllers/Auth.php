<?php

namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function __construct()
    {
        helper(['form']);
       
    }

    public function login()
    {
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function doLogin()
    {
        $session = session();
        $userModel = new UserModel();
        $email = $this->request->getVar('username');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        
        $data = $userModel->where('username', $username)->orWhere('email', $email)->first();

        if($data){
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if($authenticatePassword){
                $dataUser = [
                    'id' => $data['id'],
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'image' => $data['image'],
                    'role' => $data['role'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($dataUser);
                return redirect()->to('/');
            
            }else{
                $session->setFlashdata('error', 'Password is incorrect!');
                return redirect()->back()->withInput();
            }
        }else{
            $session->setFlashdata('error', 'Username or Email does not exit!');
            return redirect()->back()->withInput();
        }
    }

    public function doRegister()
    {
        $rules = [
            'username' => [
                'rules' => 'required|is_unique[user.username]|min_length[4]|alpha_numeric',
                'errors' => [
                    'required' => 'You must choose a username.',
                    'is_unique' => 'Username has been used.',
                    'alpha_numeric' => 'username contains only letters and numbers.'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|valid_emails|is_unique[user.email]|min_length[4]',
                'errors' => [
                    'required' => 'Please insert an e-mail.',
                    'valid_email' => 'Enter the correct e-mail.',
                    'valid_emails' => 'Enter the correct e-mail.',
                    'is_unique' => 'Email has been used.'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[4]',
                'errors' => [
                    'required' => 'Please insert a password.',
                    'min_length' => 'Your password is too short.'
                ]
            ],
            'confirm' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Passwords doesnt match!'
                ]
            ]
        ];

        if($this->validate($rules)){
            $userModel = new UserModel();
            $data = [
                'username'     => $this->request->getVar('username'),
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'image' => 'linux.jpg',
                'role' => '1'
            ];
            $userModel->save($data);
            $session = session();
            $session->setFlashdata('success', 'Your account has been created. Please log in.');       
            return redirect()->to('/login');
        }else{
            $data['validation'] = $this->validator;
            echo view('auth/register', $data);
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }

}