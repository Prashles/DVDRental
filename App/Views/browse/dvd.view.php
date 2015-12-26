<?php include view('layout.header'); ?>

<div class="container">
    <div class="page-header">
        <h1>Viewing DVD: <?php echo e($dvd->title); ?></h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <img src="<?php echo upload($dvd->image); ?>" alt="DVD Image" class="img-responsive img-thumbnail">
        </div>

        <div class="col-md-8">
            <h2><?php echo e($dvd->title) . ' - ' . e($dvd->year); ?></h2>
            <p><strong>Cast:</strong> <?php echo e($dvd->cast); ?></p>
            <p><strong>Director:</strong> <?php echo e($dvd->director); ?></p>
            <p><strong>Genre:</strong> <?php echo e($dvd->genre); ?></p>
            <p class="lead"><?php echo e($dvd->synopsis); ?></p>

            <?php if ($dvd->rented == 1): ?>
                <p class="lead">
                    <span class="label label-danger">Not Available</span>
                </p>
            <?php else: ?>
                <p class="lead">
                    <span class="label label-success">Available</span>
                </p>
                <p class="lead">
                    This DVD is available to rent for £<?php echo band2price($dvd->price_band, true); ?>
                </p>
                <p class="lead">
                    <a href="#">Add to basket &rarr;</a>
                </p>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php include view('layout.footer'); ?>