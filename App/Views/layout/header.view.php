<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Prash Somaiya">

    <link href="<?php echo asset('css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo asset('css/style.css'); ?>" rel="stylesheet">

    <title><?php echo e($title . ' - ' . getenv('SITE_TITLE')); ?></title>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo l('/'); ?>"><?php echo e(getenv('SITE_TITLE')); ?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo l('/'); ?>">Home</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Browse DVDs <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo l('browse'); ?>">All DVDs</a></li>
                    <li><a href="<?php echo l('browse/search'); ?>">Search</a></li>
                </ul>
            </li>
            <?php if (!auth()->is()): ?>
                <li><a href="<?php echo l('login'); ?>">Login</a></li>
                <li><a href="<?php echo l('register'); ?>">Register</a></li>
            <?php endif; ?>

            <?php if (auth()->isAdmin()): ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo l('admin/users'); ?>">Users</a></li>
                        <li><a href="<?php echo l('admin/rentals/current'); ?>">Rentals</a></li>
                        <li><a href="<?php echo l('admin/dvds'); ?>">DVDs</a></li>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (auth()->is()): ?>
                <?php if (basket()->count() !=  0): ?>
                    <li><a href="<?php echo l('basket'); ?>"><strong>Basket (<?php echo basket()->count(); ?>)</strong></a></li>
                <?php endif; ?>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo l('account/rentals/current'); ?>">My rentals</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?php echo l('logout'); ?>">Logout</a></li>
                  </ul>
                </li>
            <?php endif; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="container">
        <?php if (session()->hasSuccess()): ?>
            <div class="alert alert-success" id="head-success">
                <p>
                    <?php echo session()->success(); ?>
                </p>
            </div>
        <?php endif; ?>
  </div>