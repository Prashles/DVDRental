<?php include view('layout.header'); ?>
<div class="container">
    <div class="page-header">
        <h1>Login</h1>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p class="lead">Use the form below to login to your account, or, <a href="">click here</a> to register.</p>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="email">E-mail Address:</label>
                    <input type="email" name="email" class="form-control" placeholder="john.doe@example.com">
                </div>
                
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <button class="btn btn-default padding-medium" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include view('layout.footer'); ?>
