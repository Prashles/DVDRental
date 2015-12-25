<?php

namespace App\Controllers\Admin;

use App\Models\Dvd;
use App\Models\Genre;
use System\Message\Message;
use System\View\View;

class DvdsController extends AdminBaseController
{
    public function index()
    {
        return $this->response->view(
            View::create('admin.dvds.index', [
                'title' => 'Admin DVDs',
                'dvds' => (new Dvd)->allWithGenre()
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

        // Validate the image
        if (($imageValidator = Dvd::validateImage()) !== true) {
            session()->addErrors($imageValidator);
            session()->flashInput($input);
            return redirect(l('admin/dvd/add'));
        }

        // Save file with random name
        $image = $_FILES['image'];
        $name = ($image['type'] == 'image/jpeg') ? uniqid('dvd_') . '.jpg' : uniqid('dvd_') . '.png';
        if (!move_uploaded_file($_FILES['image']['tmp_name'], PUBLIC_PATH . 'uploads/' . $name)) {
            session()->addErrors(new Message(['Image was not uploaded - please try again']));
            session()->flashInput($input);
            return redirect(l('admin/dvd/add'));
        }

        // Insert into database
        $dvd = new Dvd;
        $dvd->create([
            'title' => $input['title'],
            'genre_id' => $input['genre'],
            'price_band' => $input['price'],
            'year' => $input['year'],
            'synopsis' => $input['synopsis'],
            'director' => $input['director'],
            'cast' => $input['cast'],
            'image' => $name
        ]);

        session()->addSuccess('Dvd successfully added');
        return redirect(l('admin/dvds'));
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
        $genre = new Genre;
        $genre->create([
            'name' => $input['name']
        ]);

        session()->addSuccess('Genre successfully added');
        return redirect(l('admin/dvds/genres'));
    }

}