<?php

class UserController extends Controller {

    public function index(): void {
        $users = $this->db->query("SELECT * FROM users")->fetchAll();

        $data = [
            'title' => 'Users',
            'users' => $users
        ];

        Response::view('users', $data);

        //$this->view('users', $data);
    }

    public function getUser($id) {
        $query = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $query->execute([
            'id' => $id
        ]);
        $user = $query->fetch();

        if (!$user) {
            echo 'UserID: ' . $id . ' could not be found';
            return http_response_code(404);
        }

        $data = [
            'title' => "User {$id}",
            'id' => $id,
            'user' => $user
        ];

        Response::view('user', $data);

        //$this->view('user', $data);
    }

    public function addUser() {
        $data = [
            'title' => 'Add User'
        ];

        Response::view('user_add', $data);
        
        //$this->view('user_add', $data);
    }

}