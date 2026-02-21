<?php

class RegisterController extends Controller
{

    public function index(): void
    {
        $title = 'Register';
        $errors = $_SESSION['errors'] ?? [];
        $old = $_SESSION['old'] ?? [];
        $success = $_SESSION['success'] ?? null;

        unset($_SESSION['errors'], $_SESSION['old'], $_SESSION['success']);

        View::render('auth/register', compact('title', 'errors', 'old', 'success'));
    }

    public function register()
    {
        $data = [
            'first_name' => trim($_POST['first_name'] ?? ''),
            'last_name' => trim($_POST['last_name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'password' => $_POST['password'] ?? '',
            'age' => trim($_POST['age'] ?? ''),
            'city' => trim($_POST['city'] ?? ''),
        ];

        $validator = Validator::make($data, [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'min:8'],
            'age' => ['required', 'number'],
            'city' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            $_SESSION['errors'] = $validator->errors();
            $_SESSION['old'] = $data;
            header("Location: /register");
            return;
        }

        $query = $this->db->prepare("
        INSERT INTO users (first_name, last_name, email, password, age, city)
        VALUES (:firstName, :lastName, :email, :password, :age, :city)
        ");

        $query->execute([
            'firstName' => $data['first_name'],
            'lastName' => $data['last_name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'age' => $data['age'],
            'city' => $data['city']
        ]);

        $_SESSION['success'] = 'Account created successfully.';
        header("Location: /register");
        return;
    }

}
