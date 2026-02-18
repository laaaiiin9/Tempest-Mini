<?php

class RegisterController extends Controller {

    public function index(): void {
        $this->view('auth/register', []);
    }

    public function register(): void {
        echo 'WOW!';
    }

}