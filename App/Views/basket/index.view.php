<?php include view('layout.header'); ?>

<div class="container">
    <div class="page-header">
        <h1>Basket</h1>
        <p class="lead">Here are the contents of your basket.</p>
    </div>
</div>

<div class="container">
    <?php if ($basket->count() == 0): ?>
        <p class="lead">No items in your basket.</p>
    <?php else: ?>


        <div class="row">
            <div class="col-md-2">
                <h2>Details</h2>
                <p class="lead">
                   Items: <?php echo $basket->count(); ?><br/>
                   Total: £<?php echo money_format('%i', $basket->sum()); ?>
                </p>
            </div>

            <div class="col-md-6">
                <h2>Items</h2>
                <table class="table table-hover table-striped table-bordered">
                    <tr>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Delete</th>
                    </tr>
                    <?php foreach ($dvds as $dvd): ?>
                        <tr>
                            <td><a href="<?php echo l('browse/dvd/' . $dvd->id); ?>"><?php echo e($dvd->title); ?></a></td>
                            <td>£<?php echo band2price($dvd->price_band, true) ?></td>
                            <td><a href="<?php echo l('basket/delete/' . $dvd->id); ?>">Remove from basket &rarr;</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

            <div class="col-md-3 col-md-offset-1">
                <h2>Checkout</h2>
                <p>To pay by card, please click the button below.</p>
                <form action="<?php echo l('basket/checkout'); ?>" method="POST">
                    <script
                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                        data-key="<?php echo getenv('STRIPE_PUB'); ?>"
                        data-amount="<?php echo $basket->sum() * 100; ?>"
                        data-name="DVD Rental"
                        data-description="<?php echo $basket->count(); ?> DVD(s)"
                        data-currency="GBP"
                        data-locale="auto">
                    </script>
                </form>
            </div>
        </div>

    <?php endif; ?>

</div>

<?php include view('layout.footer'); ?>
