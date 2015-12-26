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
    }

    /**
     * @param $id int
     * @return bool
     */
    public function exists($id)
    {
        return array_key_exists(md5($id), $this->items);
    }

    /**
     * @param $id int
     * @return void
     */
    public function remove($id)
    {
        if ($this->exists($id)) {
            unset($this->items[md5($id)]);
        }
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
}