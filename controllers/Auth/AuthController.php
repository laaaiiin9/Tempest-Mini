<?php

class AuthController extends Controller {

    public function index(): void {
        Response::view('auth/login', []);
    }

    public function login(): void {
        
    }

}