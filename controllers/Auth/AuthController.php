<?php

class AuthController extends Controller {

    public function index(): void {
        $this->view('auth/login', []);
    }

    public function login(): void {
        
    }

}