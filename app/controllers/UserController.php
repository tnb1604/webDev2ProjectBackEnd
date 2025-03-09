<?php

require_once(__DIR__ . "/../models/UserModel.php");
use App\Services\ResponseService;

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function getAll()
    {
        ResponseService::Send($this->userModel->getAll());
    }

    public function get($id)
    {
        ResponseService::Send($this->userModel->get($id));
    }

    public function register()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['username'], $data['email'], $data['password'])) {
            ResponseService::Send(["error" => "Missing required fields"], 400);
            return;
        }

        $result = $this->userModel->register($data['username'], $data['email'], $data['password']);

        if ($result === "exists") {
            ResponseService::Send(["error" => "Username or email already taken"], 409);
        } elseif ($result) {
            ResponseService::Send(["message" => "Registration successful"]);
        } else {
            ResponseService::Send(["error" => "Registration failed"], 500);
        }
    }


    public function login()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['email'], $data['password'])) {
            ResponseService::Send(["error" => "Missing email or password"], 400);
            return;
        }

        $user = $this->userModel->login($data['email'], $data['password']);
        if ($user) {
            $_SESSION['user_id'] = $user['id']; // Store session
            ResponseService::Send([
                "message" => "Login successful",
                "user" => [
                    "id" => $user['id'],
                    "username" => $user['username'],
                    "email" => $user['email'],
                    "role" => $user['role']
                ]
            ]);
        } else {
            ResponseService::Send(["error" => "Invalid email or password"], 401);
        }
    }
}
