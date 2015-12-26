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

    <?php foreach ($dvds as $dvd): ?>
        <div class="row">
            <div class="col-md-3"><img src="<?php echo upload($dvd->image); ?>" class="img-responsive img-circle" alt="DVD Image"></div>

            <div class="col-md-7 col-md-offset-1">
                <h2><?php echo e($dvd->title) . ' - ' . e($dvd->year); ?></h2>
                <p class="light"><?php echo e($dvd->cast); ?></p>
                <p class="lead">
                    <?php echo e($dvd->synopsis); ?>
                </p>

                <p class="lead">
                    <a href="">More info &rarr;</a>
                </p>
            </div>
        </div>
        <hr>
    <?php endforeach; ?>
</div>

<?php include view('layout.footer'); ?>
