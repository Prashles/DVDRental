<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\User;
use System\View\View;

class UsersController extends BaseController
{
    public function index()
    {
        return $this->response->view(
            View::create('admin.users.index', [
                'title' => 'Users',
                'users' => (new User)->all()
            ])
        );
    }
}