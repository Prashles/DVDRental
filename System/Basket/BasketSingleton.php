<?php

namespace System\Basket;

class BasketSingleton
{
    /**
     * @var null|Basket
     */
    protected static $instance = null;

    /**
     * @return Basket
     */
    public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new Basket;
        }

        return static::$instance;
    }

    protected function __construct()
    {

    }

    protected function __clone()
    {

    }
}