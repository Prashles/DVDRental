<?php include view('layout.header'); ?>

<div class="container">
    <div class="page-header">
        <h1>Search Results</h1>
        <p class="lead">Here are your search results.</p>
        <p><a href="<?php echo l('browse/search'); ?>">Search again &rarr;</a></p>
    </div>
</div>

<div class="container dvd-listing">

    <?php if (empty($dvds)): ?>
        <div class="row">
            <div class="col-md-6">
                <p class="lead">No search results.</p>
                <p class="lead"><a href="<?php echo l('browse/search'); ?>">Go back &rarr;</a></p>
            </div>
        </div>
    <?php endif; ?>

    <?php
    foreach ($dvds as $dvd):
        include view ('browse.dvds_list');
    endforeach;
    ?>
</div>

<?php include view('layout.footer'); ?>
