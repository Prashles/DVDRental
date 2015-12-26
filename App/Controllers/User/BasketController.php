<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\Dvd;
use Stripe\Charge;
use Stripe\Error\Card;
use Stripe\Stripe;
use System\View\View;

class BasketController extends BaseController
{
    protected $stripe;

    public function __construct()
    {
        parent::__construct();

        if (!auth()->is()) {
            notfound();
            exit;
        }

        $this->stripe = [
            'secret_key' => getenv('STRIPE_SECRET'),
            'publishable_key' => getenv('STRIPE_PUB')
        ];

        Stripe::setApiKey($this->stripe['secret_key']);
    }

    public function index()
    {
        $basket = basket();
        $dvds = [];
        foreach ($basket->all() as $dvd) { // Lazy loading :(
            $dvds[] = (new Dvd)->getById($dvd['id']);
        }

        return $this->response->view(
            View::create('basket.index', [
                'title' => 'Basket',
                'basket' => $basket,
                'dvds' => $dvds
            ])
        );
    }

    public function add($id)
    {
        $id = current($id);

        $dvd = (new Dvd)->getById($id);

        if (empty($dvd)) {
            return notfound();
        }

        if ($dvd->rented == 1) {
            return notfound();
        }

        basket()->add($id, band2price($dvd->price_band));

        session()->addSuccess('DVD successfully added to basket');
        return redirect(l('basket'));
    }

    public function remove($id)
    {
        basket()->remove(current($id));

        session()->addSuccess('DVD successfully remvoed from basket');
        return redirect(l('basket'));
    }

    public function checkout()
    {
        try {
            // charge
        } catch (Card $e) {
        }
    }

}