<?php

/*
 * Define routes
 */
return [
  ['GET', '/test', ['App\Controllers\TestController', 'test']],
  ['GET', '/', ['App\Controllers\User\HomeController', 'index']]
];