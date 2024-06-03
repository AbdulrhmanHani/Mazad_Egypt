<?php

use MazadEgypt\Classes\Models\Cat;

require_once('inc/header.php'); ?>
<?php
$c = new Cat;
$cats = $c->selectAll();
// echo '<pre>';
// print_r($cats);
// echo '</pre>';
?>
<div class="container-fluid py-5">
    <div class="row">

        <div class="col-md-10 offset-md-1">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>All Categories</h3>
                <a href="<?= AURL; ?>add-category.php" class="btn btn-success">
                    Add new
                </a>
            </div>

            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Name</th>
                        <th scope="col">Arabic Name</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cats as $index => $cat) { ?>
                        <tr>
                            <th scope="row"><?= $index + 1; ?></th>
                            <td><?= $cat['name']; ?></td>
                            <td><?= $cat['arabic_name']; ?></td>
                            <td><?= $cat['created_at']; ?></td>
                            <td>
                                <a class="btn btn-sm btn-info" href="<?= AURL . "edit-category.php?id=" . $cat['id']; ?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a class="btn btn-sm btn-danger" href="<?= AURL . "handlers/remove-cat.php?id=" . $cat['id']; ?>">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
<?php require_once("inc/footer.php"); ?>