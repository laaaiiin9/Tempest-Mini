<?php

require_once BASE_PATH . '/db/models/UserModel.php';

class UserController extends Controller {

    public function index(): void {
        $users = UserModel::all();

        $data = [
            'title' => 'Users',
            'users' => $users
        ];

        Response::view('users', $data);
    }

    public function getUser($id) {

        // $query = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        // $query->execute([
        //     'id' => $id
        // ]);
        // $user = $query->fetch();

        $user = UserModel::where('id', $id)->first();

        if (!$user) {
            // echo 'UserID: ' . $id . ' could not be found';
            // return http_response_code(404);
            $msg = 'UserID: ' . $id . ' could not be found';
            Response::abort(404, $msg);
        }

        $data = [
            'title' => "User {$id}",
            'id' => $id,
            'user' => $user
        ];

        Response::view('user', $data);
    }

    public function addUser() {
        $data = [
            'title' => 'Add User'
        ];

        Response::view('user_add', $data);
    }

}