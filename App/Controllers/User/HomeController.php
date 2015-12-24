<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use Symfony\Component\HttpFoundation\Session\Session;
use System\View\View;

class HomeController extends BaseController
{
    public function index()
    {
        return $this->response->view(
            View::create('home', ['title' => 'Home'])
        );
    }
}