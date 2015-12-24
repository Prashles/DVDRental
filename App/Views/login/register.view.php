<?php include view('layout.header'); ?>
<div class="container">
    <div class="page-header">
        <h1>Register</h1>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p class="lead">Use the form below to register. If you already have an account, <a href="">click here</a> to login.</p>
            <form action="<?php echo l('register'); ?>" method="POST">

                <?php if(session()->hasErrors()): ?>
                    <div class="alert alert-danger">
                        <p><?php echo session()->getErrors()->first(); ?></p>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="email">E-mail Address:</label>
                    <input type="email" name="email" class="form-control" placeholder="john.doe@example.com">
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password">Confirm Password:</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="text" name="phone" class="form-control" placeholder="07123456789">
                </div>

                <div class="form-group">
                    <button class="btn btn-default padding-medium" type="submit">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include view('layout.footer'); ?>
