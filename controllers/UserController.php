<?php

class UserController extends Controller {

    public function index(): void {
        $this->view('users', ['title' => 'Users']);
    }

    public function getUser($id) {
        $data = [
            'title' => "User {$id}",
            'id' => $id
        ];

        $this->view('user', $data);
    }

    public function addUser() {
        $data = [
            'title' => 'Add User'
        ];
        
        $this->view('user_add', $data);
    }

}