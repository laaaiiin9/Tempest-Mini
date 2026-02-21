<?php

require_once BASE_PATH . '/db/models/UserModel.php';

class UserController extends Controller {

    public function index(): void {
        $title = 'Users';
        $users = UserModel::all();

        View::render('users', compact('users', 'title'));
    }

    public function getUser($id) {

        $user = UserModel::where('id', $id)->first();

        if (!$user) {
            $msg = 'UserID: ' . $id . ' could not be found';
            throw new Exception();
        }
        $title = "User {$id}";

        View::render('user', compact('user', 'title'));
    }

    public function addUser() {
        $data = [
            'title' => 'Add User'
        ];

        View::render('user_add', ['title' => 'Add User']);
    }

}