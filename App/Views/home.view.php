<?php include view('layout.header'); ?>
<div class="container">
    <div class="page-header">
        <h1>DVD Rental Website</h1>
    </div>
    <p class="lead">
        Welcome to the DVD Rental Website. You can browse our selection of DVDs and rent them, prices starting from just £1.00! You can view <a href="<?php echo l('browse/search'); ?>">search for DVDs</a>, or, <a href="<?php echo l('browse'); ?>">click here</a> to view our entire range.
    </p>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form class="form" action="movie.php" method="GET">
                <div class="form-group">
                    <label for="genre">Search by Genre</label>
                    <select class="form-control" name="genre" id="genre">
                        <?php foreach($view->genres as $genre) { ?>
                            <option value="">Any</option>
                            <option value="<?php echo $genre; ?>"><?php echo $genre; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="director">Search by Director</label>
                    <input id="director" name="director" type="text" placeholder="" class="form-control input-md">
                </div>

                <div class="form-group">
                    <label for="title">Search by Title</label>
                    <input id="title" name="title" type="text" placeholder="" class="form-control input-md">
                </div>
                <button type="submit" class="btn btn-default">Search</button>
            </form>
        </div>
    </div>
</div>


<?php include view('layout.footer'); ?>
