<?php

class HomeController extends Controller {

    public function index(): void {
        $title = 'Home';
        
        View::render('home', compact('title'));
        // Response::view('home', ['title' => 'Home']);
    }

}