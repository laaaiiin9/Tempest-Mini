<?php

class AuthController extends Controller {

    public function index(): void {
        Response::view('auth/login', []);
        //$this->view('auth/login', []);
    }

    public function login(): void {
        
    }

}