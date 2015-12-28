<?php include view('layout.header'); ?>

<div class="container">
    <div class="page-header">
        <h1>Users</h1>
        <p class="lead">Here are all the users registered to the site.</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <th>#</th>
                    <th>E-mail Address</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Level</th>
                    <th>Registered</th>
                </tr>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user->id; ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td><?php echo e($user->phone); ?></td>
                        <td><?php echo e($user->address); ?></td>
                        <td><?php echo $user->level < 5 ? 'User' : 'Admin'; ?></td>
                        <td><?php echo e($user->created_at); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>

<?php include view('layout.footer'); ?>
