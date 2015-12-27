<?php

namespace App\Controllers\User;

use App\Models\Rental;
use System\View\View;

class AccountController extends BaseAuthController
{
    public function currentRentals()
    {
        return $this->response->view(
            View::create('account.current_rentals', [
                'title' => 'Current Rentals',
                'rentals' => (new Rental)->userCurrent(auth()->user()->id)
            ])
        );
    }

    public function returnedRentals()
    {
        return $this->response->view(
            View::create('account.returned_rentals', [
                'title' => 'Returned Rentals',
                'rentals' => (new Rental)->userReturned(auth()->user()->id)
            ])
        );
    }
}