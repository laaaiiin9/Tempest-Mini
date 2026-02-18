<?php

class RegisterController extends Controller {

    public function index(): void {
        $this->view('auth/register', []);
    }

    public function register() {
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $age = $_POST['age'];
        $city = $_POST['city'];

        $query = $this->db->prepare("
        INSERT INTO users (first_name, last_name, email, password, age, city)
        VALUES (:firstName, :lastName, :email, :password, :age, :city)
        ");

        $query->execute([
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'age' => $age,
            'city' => $city
        ]);

        return header("Location: /register?message=Success");
    }

}