<?php


use App\Services\ResponseService;
use App\Controllers\Controller;
use \Firebase\JWT\JWT;
require_once __DIR__ . '/../models/UserModel.php';

class UserController extends Controller
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
        $data = $this->decodePostData(); // Use base controller method to get POST data
        if (empty($data['username']) || empty($data['email']) || empty($data['password'])) {
            ResponseService::Error("Missing required fields: username, email, or password", 400);
            return;
        }
        $this->validateInput(['username', 'email', 'password'], $data); // Use base controller validation

        // Validate field lengths
        $this->validateFields($data, [
            'username' => 50,
            'email' => 100,
            'password' => 64
        ]);

        // Check if email already exists
        if ($this->userModel->findByEmail($data['email'])) {
            ResponseService::Error('Email already exists', 400);
            return;
        }

        // Check if username already exists
        if ($this->userModel->findByUsername($data['username'])) {
            ResponseService::Error('Username already exists', 400);
            return;
        }

        // create user
        try {
            $this->userModel->create($data['username'], $data['email'], $data['password']);
            return ResponseService::Send(['message' => 'User registered successfully']);
        } catch (\Exception $e) {
            ResponseService::Error('Registration failed: ' . $e->getMessage(), 500);
        }
    }


    public function login()
    {
        // Get and parse the JSON request body using base controller method
        $data = $this->decodePostData();
        if (empty($data['email']) || empty($data['password'])) {
            ResponseService::Error("Missing required fields: email or password", 400);
            return;
        }
        // Validate that required fields (email & password) exist in request
        $this->validateInput(['email', 'password'], $data);

        // Validate field lengths
        $this->validateFields($data, [
            'email' => 100,
            'password' => 64
        ]);

        // Try to find user with the provided email
        $user = $this->userModel->findByEmail($data['email']);

        // Check if user exists and password matches
        // password_verify securely compares the provided password against the stored hash
        if (!$user || !password_verify($data['password'], $user['password_hash'])) {
            ResponseService::Error('Invalid credentials. Please check your email or password.', 401);
            return;
        }

        // Generate a JWT token containing user data
        $token = $this->generateJWT($user);

        // Return the token in the response
        ResponseService::Send(['token' => $token]);
    }

    public function me()
    {
        ResponseService::Send($this->getAuthenticatedUser());
    }

    private function generateJWT($user)
    {
        $issuedAt = time();
        $expire = $issuedAt + 3600 * 4; // 4 hours

        $payload = [
            'iat' => $issuedAt,
            'exp' => $expire,
            'user' => [
                'id' => $user['id'],
                //'username' => $user['username'],
                //'email' => $user['email'],
                'role' => $user['role']
            ]
        ];

        return JWT::encode($payload, $_ENV["JWT_SECRET"], 'HS256');
    }

    public function isMe($id)
    {
        $this->validateIsMe($id);
        ResponseService::Send(['message' => 'You are authorized to access this resource']);
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        ResponseService::Send(['message' => 'User deleted successfully']);
    }
}
