<?php

class AuthController extends Controller {

    public function index(): void {
        View::render('auth/login', ['title' => 'Login']);
    }

    public function login(): void {
        
    }

}