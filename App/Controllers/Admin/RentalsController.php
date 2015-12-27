<?php

namespace App\Controllers\Admin;

use App\Models\Rental;
use System\View\View;

class RentalsController extends AdminBaseController
{
    public function current()
    {
        return $this->response->view(
            View::create('admin.rentals.current', [
                'title' => 'Rentals',
                'rentals' => (new Rental)->current()
            ])
        );
    }

    public function returned()
    {
        return $this->response->view(
            View::create('admin.rentals.returned', [
                'title' => 'Returned rentals',
                'rentals' => (new Rental)->returned()
            ])
        );
    }

    public function returnDvd($id)
    {
        (new Rental)->returnDvd(current($id));

        session()->addSuccess('Rental successfully marked as returned');
        return redirect(l('admin/rentals/current'));
    }
}