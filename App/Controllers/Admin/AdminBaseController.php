<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class AdminBaseController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        if (!auth()->isAdmin()) {
            die('Permission denied');
        }
    }
}