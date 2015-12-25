<?php include view('layout.header'); ?>

    <div class="container">
        <div class="page-header">
            <h1>Actors</h1>
            <p class="lead">
                All the actors currently in the system.
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
                    <?php foreach ($actors as $actor): ?>
                        <tr>
                            <td><?php echo $actor->id; ?></td>
                            <td><?php echo $actor->name; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

        </div>
    </div>

<?php include view('layout.footer'); ?>