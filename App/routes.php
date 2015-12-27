<?php

/*
 * Define routes
 */
return [
    ['GET', '/test', ['App\Controllers\TestController', 'test']],
    ['GET', '/', ['App\Controllers\User\HomeController', 'index']],

    // Login routes
    ['GET', '/login', ['App\Controllers\User\LoginController', 'getLogin']],
    ['POST', '/login', ['App\Controllers\User\LoginController', 'postLogin']],
    ['GET', '/register', ['App\Controllers\User\LoginController', 'getRegister']],
    ['POST', '/register', ['App\Controllers\User\LoginController', 'postRegister']],
    ['GET', '/logout', ['App\Controllers\User\LoginController', 'getLogout']],

    // Browse routes
    ['GET', '/browse', ['App\Controllers\User\BrowseController', 'index']],
    ['GET', '/browse/search', ['App\Controllers\User\BrowseController', 'search']],
    ['POST', '/browse/search', ['App\Controllers\User\BrowseController', 'processSearch']],
    ['GET', '/browse/dvd/{id:\d+}', ['App\Controllers\User\BrowseController', 'dvd']],

    // Basket routes
    ['GET', '/basket', ['App\Controllers\User\BasketController', 'index']],
    ['GET', '/basket/add/{id:\d+}', ['App\Controllers\User\BasketController', 'add']],
    ['GET', '/basket/delete/{id:\d+}', ['App\Controllers\User\BasketController', 'remove']],
    ['POST', '/basket/checkout', ['App\Controllers\User\BasketController', 'checkout']],

    // Admin routes
    // Users
    ['GET', '/admin/users', ['App\Controllers\Admin\UsersController', 'index']],

    // DVDs
    ['GET', '/admin/dvds', ['App\Controllers\Admin\DvdsController', 'index']],
    ['GET', '/admin/dvd/add', ['App\Controllers\Admin\DvdsController', 'addDvd']],
    ['POST', '/admin/dvd/store', ['App\Controllers\Admin\DvdsController', 'storeDvd']],
    ['GET', '/admin/dvds/genres', ['App\Controllers\Admin\DvdsController', 'genres']],
    ['GET', '/admin/dvds/genre/add', ['App\Controllers\Admin\DvdsController', 'addGenre']],
    ['POST', '/admin/dvds/genre/store', ['App\Controllers\Admin\DvdsController', 'storeGenre']],

    // Rentals
    ['GET', '/admin/rentals/current', ['App\Controllers\Admin\RentalsController', 'current']],
    ['GET', '/admin/rentals/returned', ['App\Controllers\Admin\RentalsController', 'returned']],
    ['GET', '/admin/rentals/return/{id:\d+}', ['App\Controllers\Admin\RentalsController', 'returnDvd']],

    // Account routes
    ['GET', '/account/rentals/current', ['App\Controllers\User\AccountController', 'currentRentals']],
    ['GET', '/account/rentals/returned', ['App\Controllers\User\AccountController', 'returnedRentals']],
];