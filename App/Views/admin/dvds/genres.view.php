<?php include view('layout.header'); ?>

    <div class="container">
        <div class="page-header">
            <h1>Genres</h1>
            <p class="lead">
                All the genres currently in the system.
            </p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <?php include view('admin.dvds.sidebar'); ?>

            <div class="col-md-5">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                    </tr>
                    <?php foreach ($genres as $genre): ?>
                        <tr>
                            <td><?php echo $genre->id; ?></td>
                            <td><?php echo e($genre->name); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

        </div>
    </div>

<?php include view('layout.footer'); ?>