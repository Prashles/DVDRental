<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Dvd;
use App\Models\Genre;
use System\View\View;

class DvdsController extends BaseController
{
    public function index()
    {
        return $this->response->view(
            View::create('admin.dvds.index', [
                'title' => 'Admin DVDs',
                'dvds' => (new Dvd)->all()
            ])
        );
    }

    public function addDvd()
    {
        return $this->response->view(
            View::create('admin.dvds.add_dvd', [
                'title' => 'Admin DVDs',
                'genres' => (new Genre)->all()
            ])
        );
    }

    public function storeDvd()
    {
        $input = $this->request->request->all();

        // Validate the data
        if (($validator = Dvd::validate($input)) !== true) {
            session()->addErrors($validator);
            session()->flashInput($input);
            return redirect(l('admin/dvd/add'));
        }
    }

    public function genres()
    {
        return $this->response->view(
            View::create('admin.dvds.genres', [
                'title' => 'Genres',
                'genres' => (new Genre)->all()
            ])
        );
    }

    public function addGenre()
    {
        return $this->response->view(
            View::create('admin.dvds.add_genre', [
                'title' => 'Add Genre'
            ])
        );
    }

    public function storeGenre()
    {
        $input = $this->request->request->all();

        // Validate the data
        if (($validator = Genre::validate($input)) !== true) {
            session()->addErrors($validator);
            session()->flashInput($input);
            return redirect(l('admin/dvds/genre/add'));
        }

        // Create the user
        $actor = new Genre;
        $actor->create([
            'name' => $input['name']
        ]);

        session()->addSuccess('Genre successfully added');
        return redirect(l('admin/dvds/genres'));
    }

}