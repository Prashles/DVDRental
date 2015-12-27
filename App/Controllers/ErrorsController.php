<?php

namespace App\Controllers;

use System\View\View;

class ErrorsController extends BaseController
{
    public function show404()
    {
        return $this->response->view(
            View::create('errors.404', [
                'title' => 'Page not found'
            ])
        );
    }

}