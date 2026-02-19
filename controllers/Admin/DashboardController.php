<?php

class DashboardController extends Controller {

    public function index(): void {
        Response::view('admin/dashboard', ['title' => 'Dashboard'])->layout('admin');
    }

}