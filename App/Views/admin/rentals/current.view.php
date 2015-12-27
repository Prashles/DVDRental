<?php include view('layout.header'); ?>

<div class="container">
    <div class="page-header">
        <h1>Current Rentals</h1>
        <p class="lead">DVDs currently with customers.</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <?php include view('admin.rentals.sidebar'); ?>

        <div class="col-md-9">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th>DVD Title</th>
                    <th>User Email</th>
                    <th>Price Band</th>
                    <th>Date</th>
                    <th>Return</th>
                </tr>
                <?php if (empty($rentals)): ?>
                    <tr>
                        <td colspan="5" style="text-align: center">No DVDs currently out for rental</td>
                    </tr>
                <?php endif; ?>
                <?php foreach ($rentals as $rental): ?>
                    <tr>
                        <td><?php echo e($rental->title); ?></td>
                        <td><?php echo e($rental->email); ?></td>
                        <td><?php echo e($rental->price_band); ?></td>
                        <td><?php echo e($rental->rented_at); ?></td>
                        <td><a href="<?php echo l('admin/rentals/return/' . $rental->rental_id); ?>">Returned &rarr;</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

    </div>
</div>

<?php include view('layout.footer');