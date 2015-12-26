<?php

namespace System\Basket;

/*
 * A simple basket class
 * Very minimal functionality, only for this project
 */

class Basket
{
    /**
     * @var array
     */
    protected $items = [];

    public function __construct()
    {
        $items = session()->get('_basket');

        if ($items != null) {
            $this->items = $items;
        }
    }

    /**
     * @param $id int
     * @param $price float
     * @return void
     */
    public function add($id, $price)
    {
        if (!$this->exists($id)) {
            $this->items[] = [
                md5($id) => [
                    'id' => $id,
                    'price' => $price
                ]
            ];
        }

        session()->set('_basket', $this->items);
    }

    /**
     * @param $id int
     * @return bool
     */
    public function exists($id)
    {
        foreach ($this->items as $key => $value) {
            if (array_keys($value)[0] == md5($id)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $id int
     * @return void
     */
    public function remove($id)
    {
        for ($i = 0; $i < count($this->items); $i++) {
            if (array_keys($this->items[$i])[0] == md5($id)) {
                unset($this->items[$i]);
            }
        }

        $this->items = array_values($this->items);
        $this->update();
    }

    public function update()
    {
        session()->set('_basket', $this->items);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * @return float
     */
    public function sum()
    {
        if ($this->count() == 0) {
            return (float) 0;
        }

        $sum = (float) 0;

        foreach ($this->items as $item) {
            $item = current($item);
            $sum += $item['price'];
        }

        return $sum;
    }

    /**
     * @return array
     */
    public function all()
    {
        $out = [];

        foreach ($this->items as $item) {
            $out[] = current($item);
        }

        return $out;
    }
}