<?php

class HomeController extends Controller {

    public function index(): void {
        Response::view('home', ['title' => 'Home']);
        // $this->view('home', ['title' => 'Home']);
    }

}