<div class="row">
    <div class="col-md-3"><img src="<?php echo upload($dvd->image); ?>" class="img-responsive img-circle" alt="DVD Image"></div>

    <div class="col-md-7 col-md-offset-1">
        <h2><?php echo e($dvd->title) . ' - ' . e($dvd->year); ?></h2>
        <p class="light"><?php echo e($dvd->cast); ?></p>
        <p class="lead">
            <?php echo e($dvd->synopsis); ?>
        </p>

        <p class="lead">
            Availability: <?php echo ($dvd->rented == 0) ? '<span class="label label-success">Available</span>' : '<span class="label label-danger">Rented</span>'; ?>
        </p>

        <p class="lead">
            <a href="<?php echo l('browse/dvd/' . $dvd->id); ?>">More info &rarr;</a>
        </p>
    </div>
</div>
<hr>