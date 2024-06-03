<?php

use MazadEgypt\Classes\Models\Cat;

require_once('../app.php');
$c = new Cat;
$id = $request->get("id");
$cat = $c->selectId($id);
if (!$cat) {
    echo "Bad request";
} else {
    require_once('inc/header.php');
?>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h3 class="mb-3">Edit Category : <span class="text-info"><?= $cat['name'] ?></span></h3>
                <div class="card">
                    <div class="card-body p-5">
                        <form method="GET" action="<?= AURL; ?>handlers/edit-cat.php?id=<?= $cat['id']; ?>">
                            <div class="form-group">
                                <label>Name</label>
                                <input placeholder="<?= $cat['name']; ?>" type="text" class="form-control">
                            </div>
                            <div class="text-center mt-5">
                                <a href="<?= AURL; ?>handlers/edit-cat.php?id=<?= $cat['id'] ?>" class="btn btn-primary">Update</a>
                                <!-- <button type="submit" name="id" class="btn btn-primary">Update</button> -->
                                <a class="btn btn-dark" href="<?= AURL; ?>categories.php">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once("inc/footer.php"); ?>
<?php } ?>