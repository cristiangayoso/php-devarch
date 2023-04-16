<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\UserModel;

class Users extends BaseController
{
    private UserModel $userModel;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger) 
    {
        parent::initController($request, $response, $logger);
        $this->userModel = model('UserModel');
    }

    public function index($id = false)
    {
        return view('Users/crud', [
            'user' => $this->userModel->find($id),
            'users' => $this->userModel->findAll(0, 100)
        ]);
    }

    public function create()
    {
        $data = [
            'login' => $_POST["login"],
            'password' => sha1($_POST["password"])
        ];

        $this->userModel->insert($data);

        return view('Users/crud', [
            'users' => $this->userModel->findAll(0, 100), 
            'infoMessage' => (object) ["message" => "User created successfully", "class" => "success"]
        ]);
    }

    public function update()
    {
        $user = $this->userModel->find($_POST["id-edit"]);
        if (!empty($user)) 
        {
            $data = [
                'login' => $_POST["login"],
                'password' => sha1($_POST["password"])
            ];
            $this->userModel->where("id = " . $_POST["id-edit"])->set($data)->update();

            return view('Users/crud', [
                'users' => $this->userModel->findAll(0, 100), 
                'infoMessage' => (object) ["message" => "User updated successfully", "class" => "success"]
            ]);
        } else {
            return view('Users/crud', [
                'users' => $this->userModel->findAll(0, 100), 
                'infoMessage' => (object) ["message" => "User not found", "class" => "warning"]
            ]);
        }
    }

    public function delete($id = false)
    {
        $user = $this->userModel->find($id);
        if (!empty($user)) 
        {
            $this->userModel->where("id = " . $id)->delete();

            return view('Users/crud', [
                'users' => $this->userModel->findAll(0, 100), 
                'infoMessage' => (object) ["message" => "User deleted successfully", "class" => "success"]
            ]);
        } else {
            return view('Users/crud', [
                'users' => $this->userModel->findAll(0, 100), 
                'infoMessage' => (object) ["message" => "User not found", "class" => "warning"]
            ]);
        }
        exit;
    }
}
