<?php

class HomeController extends Controller {

    public function index(): void {
        Response::view('home', 200, ['title' => 'Home']);
        // $this->view('home', ['title' => 'Home']);
    }

}