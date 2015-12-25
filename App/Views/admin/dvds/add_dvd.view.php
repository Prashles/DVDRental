<?php include view('layout.header'); ?>

    <div class="container">
        <div class="page-header">
            <h1>Add DVD</h1>
            <p class="Add a new DVD to the system."></p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <?php include view('admin.dvds.sidebar'); ?>

            <div class="col-md-5">
                <h2>Add a new DVD</h2>

                <form style="padding-bottom: 30px;" action="<?php echo l('admin/dvd/store'); ?>" method="POST" enctype="multipart/form-data">
                    <?php if(session()->hasErrors()): ?>
                        <div class="alert alert-danger">
                            <p><?php echo session()->getErrors()->first(); ?></p>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="name">Title:</label>
                        <input type="text" name="title" <?php oldInput('title'); ?> class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="genre">Genre:</label>
                        <select name="genre" class="form-control">
                            <?php
                            $oldGenre = oldInput('genre', false);
                            foreach ($genres as $genre): ?>
                                <option <?php if ($oldGenre == $genre->id) echo 'selected="selected"'; ?> value="<?php echo $genre->id; ?>"><?php echo $genre->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="director">Director:</label>
                        <input type="text" name="director" <?php oldInput('director'); ?> class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="year">Release Year:</label>
                        <input type="number" name="year" <?php oldInput('year'); ?> class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="image">Image (max size 512kb, png and jpeg only):</label>
                        <input type="file" name="image">
                    </div>

                    <div class="form-group">
                        <label for="synopsis">Synopsis:</label>
                        <textarea name="synopsis" class="form-control" cols="30" rows="5"><?php echo oldInput('synopsis', false); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="cast">Cast:</label>
                        <textarea name="cast" class="form-control" cols="30" rows="5"><?php echo oldInput('cast', false); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="price">Price band:</label>
                        <select name="price" class="form-control">
                            <?php $oldPrice = oldInput('price', false); ?>
                            <option <?php if ($oldGenre == 'A') echo 'selected="selected"'; ?> value="A">A - £3.50</option>
                            <option <?php if ($oldGenre == 'B') echo 'selected="selected"'; ?> value="B">B - £2.50</option>
                            <option <?php if ($oldGenre == 'C') echo 'selected="selected"'; ?> value="C">C - £1.00</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-default">Submit</button>
                </form>

            </div>

        </div>
    </div>

<?php include view('layout.footer');