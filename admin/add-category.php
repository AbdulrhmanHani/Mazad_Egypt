<?php require_once('inc/header.php');
require_once("../app.php");
?>

<div class="container py-5">
    <div class="row">

        <div class="col-md-6 offset-md-3">
            <h3 class="mb-3">Add Category</h3>
            <div class="card">
                <div class="card-body p-5">

                    <?php if ($session->has("CatErrors")) { ?>
                        <?php foreach ($session->get("CatErrors") as $error) { ?>
                            <h4 class="text-danger"><?= $error ?></h4>
                        <?php } ?>
                        <?php $session->remove("CatErrors"); ?>
                    <?php } ?>

                    <form method="POST" action="<?= AURL; ?>handlers/add-category.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Name</label>
                            <input name="catName" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Arabic Name</label>
                            <input name="catArabicName" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input name="image" type="file" class="form-control">
                        </div>
                        <div class="text-center mt-5">
                            <button type="submit" name="submit" class="btn btn-primary">Add Category</button>
                            <a class="btn btn-dark" href="<?= AURL; ?>categories.php">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<?php require_once("inc/footer.php"); ?>