<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\Dvd;
use App\Models\Rental;
use App\Models\Transaction;
use Stripe\Charge;
use Stripe\Error\Card;
use Stripe\Stripe;
use System\Message\Message;
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
            $charge = Charge::create([
                'amount' => basket()->sum() * 100,
                'currency' => 'GBP',
                'source' => $this->request->request->get('stripeToken')
            ]);

            // Insert the transaction into th DB
            (new Transaction)->create([
                'user_id' => auth()->user()->id,
                'transaction_id' => $charge->id
            ]);

            // Marks the DVD(s) as rented
            foreach (basket()->all() as $dvd) {
                (new Dvd)->rent($dvd['id'], auth()->user()->id);
            }

            // Remove from basket
            basket()->clear();

            // Success
            session()->addSuccess('DVDs successfully rented!');
            return redirect(l('/'));


        } catch (Card $e) {
            session()->addErrors(new Message(['Something went wrong with your transaction, please try again.']));
            return redirect(l('basket'));
        }
    }

}