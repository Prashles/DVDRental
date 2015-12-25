<?php include view('layout.header'); ?>

    <div class="container">
        <div class="page-header">
            <h1>Add DVD</h1>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <?php include view('admin.dvds.sidebar'); ?>

            <div class="col-md-5">
                <h2>Add a new actor</h2>

                <form action="<?php echo l('admin/dvds/actor/store'); ?>" method="POST">
                    <?php if(session()->hasErrors()): ?>
                        <div class="alert alert-danger">
                            <p><?php echo session()->getErrors()->first(); ?></p>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" <?php oldInput('name'); ?> class="form-control">
                    </div>

                    <button type="submit" class="btn btn-default">Submit</button>
                </form>

            </div>

        </div>
    </div>

<?php include view('layout.footer');