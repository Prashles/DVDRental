<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\Dvd;
use App\Models\Genre;
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

    public function search()
    {
        return $this->response->view(
            View::create('browse.search', [
                'title' => 'Search DVDs',
                'genres' => (new Genre)->all()
            ])
        );
    }

    public function processSearch()
    {
        $input = $this->request->request->all();

        return $this->response->view(
            View::create('browse.search_results', [
                'title' => 'Search Result',
                'dvds' => (new Dvd)->search($input)
            ])
        );
    }

    public function dvd($id)
    {
        d($id);
    }
}