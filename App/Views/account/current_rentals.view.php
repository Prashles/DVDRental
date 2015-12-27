<?php include view('layout.header'); ?>

    <div class="container">
        <div class="page-header">
            <h1>Current Rentals</h1>
            <p class="lead">DVDs you have yet to return.</p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <?php include view('account.rentals_sidebar'); ?>

            <div class="col-md-9">
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th>DVD Title</th>
                        <th>Rental Date</th>
                    </tr>
                    <?php if (empty($rentals)): ?>
                        <tr>
                            <td colspan="2" style="text-align: center">No DVDs currently out for rental</td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach ($rentals as $rental): ?>
                        <tr>
                            <td><a href="<?php echo l('browse/dvd/' . $rental->id); ?>"><?php echo e($rental->title); ?></a></td>
                            <td><?php echo e($rental->rented_at); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

        </div>
    </div>

<?php include view('layout.footer');