<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\Dvd;
use System\View\View;

class BrowseController extends BaseController
{
    public function index()
    {
        return $this->response->view(
            View::create('browse.index', [
                'title' => 'Browse DVDs',
                'dvds' => (new Dvd)->allWithGenre()
            ])
        );
    }

}