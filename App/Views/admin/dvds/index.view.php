<?php include view('layout.header'); ?>

<div class="container">
    <div class="page-header">
        <h1>DVDs</h1>
        <p class="lead">DVDs currently in the system.</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <?php include view('admin.dvds.sidebar'); ?>

        <div class="col-md-9">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th></th>
                    <th>Title</th>
                    <th>Director</th>
                    <th>Genre</th>
                    <th>Price Band</th>
                    <th>Year</th>
                    <th>Synopsis</th>
                    <th>Director</th>
                    <th>Cast</th>
                </tr>
                <?php foreach ($dvds as $dvd): ?>
                    <tr>
                        <td><a href="<?php echo upload($dvd->image); ?>" target="_blank"><img src="<?php echo upload($dvd->image); ?>" alt="DVD Image" class="img-responsive img-thumbnail"/></a></td>
                        <td><?php echo e($dvd->title); ?></td>
                        <td><?php echo e($dvd->director); ?></td>
                        <td><?php echo e($dvd->genre); ?></td>
                        <td><?php echo e($dvd->price_band); ?></td>
                        <td><?php echo e($dvd->year); ?></td>
                        <td><?php echo e($dvd->synopsis); ?></td>
                        <td><?php echo e($dvd->director); ?></td>
                        <td><?php echo e($dvd->cast); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

    </div>
</div>

<?php include view('layout.footer');