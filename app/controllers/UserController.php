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
        $this->validateInput(['username', 'email', 'password'], $data); // Use base controller validation

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



        // Validate that required fields (email & password) exist in request
        $this->validateInput(['email', 'password'], $data);

        // Try to find user with the provided email
        $user = $this->userModel->findByEmail($data['email']);

        // Check if user exists and password matches
        // password_verify securely compares the provided password against the stored hash
        if (!$user || !password_verify($data['password'], $user['password_hash'])) {
            ResponseService::Error('Invalid credentials123', 401);
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
}
