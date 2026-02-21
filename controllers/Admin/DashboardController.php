<?php

class DashboardController extends Controller {

    public function index(): void {
        View::render('admin/dashboard', ['title' => 'Dashboard']);
    }

}