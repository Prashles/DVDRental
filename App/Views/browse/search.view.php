<?php include view('layout.header'); ?>

<div class="container">
    <div class="page-header">
        <h1>Search DVDs</h1>
        <p class="lead">Use the form below to search through our selection.</p>
    </div>
</div>

<div class="container">
    <h2>Search</h2>
    <div class="row">
        <div class="col-md-6">
            <form action="<?php echo l('browse/search'); ?>" method="post">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" class="form-control" placeholder="Leave blank for any">
                </div>

                <div class="form-group">
                    <label for="director">Director:</label>
                    <input type="text" name="director" class="form-control" placeholder="Leave blank for any">
                </div>

                <div class="form-group">
                    <label for="genre">Genre:</label>
                    <select name="genre" class="form-control">
                        <option value="any">Any</option>
                        <?php foreach ($genres as $genre): ?>
                            <option value="<?php echo $genre->id; ?>"><?php echo $genre->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-default">Search</button>


            </form>
        </div>
    </div>
</div>

<?php include view('layout.footer'); ?>
