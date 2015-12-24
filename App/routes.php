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
    ['GET', '/browse', ['App\Controllers\User\BrowseController', 'getBrowse']],
];