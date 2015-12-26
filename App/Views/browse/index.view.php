<?php include view('layout.header'); ?>

<div class="container">
    <div class="page-header">
        <h1>Browse</h1>
        <p class="lead">Here you can browse our entire selected of DVDs and, if they're available, you can add them to your basket to rent. If you'd like to search for a DVD, you can do so <a href="">here</a>.</p>
    </div>
</div>

<div class="container dvd-listing">

    <?php
    foreach ($dvds as $dvd):
        include view ('browse.dvds_list');
    endforeach;
    ?>
</div>

<?php include view('layout.footer'); ?>
