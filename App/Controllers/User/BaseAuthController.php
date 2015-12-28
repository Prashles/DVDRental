<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

abstract class BaseAuthController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        if (!auth()->is()) {
            notfound();
            exit;
        }
    }

}