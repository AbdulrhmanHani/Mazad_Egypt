<?php

use MazadEgypt\Classes\Models\Admin;

require_once('inc/header.php');
$AD = new Admin;
$ADMINS = $AD->selectAll();
?>
<div class="container-fluid py-5">
    <div class="row">
        <div class="col-md-10 offset-md-1">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>All Admins</h3>

                <?php if ($admin['is_super'] == "yes") { ?>
                    <a href="<?= AURL . "add-admin.php"; ?>" class="btn btn-success">
                        Add New Admin
                    </a>
                <?php } ?>

            </div>

            <div class="col-md-10 offset-md-1">

                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Created At</th>

                            <th scope="col">Is Super</th>
                            <?php if ($admin['is_super'] == "yes") { ?>
                                <th scope="col">Actions</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ADMINS as $index => $ADMIN) { ?>
                            <tr>
                                <th scope="row"><?= $index + 1 ?></th>
                                <?php if ($admin['name'] == $ADMIN['name']) { ?>
                                    <td class="text-info"><?= $ADMIN['name']; ?></td>
                                <?php } else { ?>
                                    <td><?= $ADMIN['name']; ?></td>
                                <?php } ?>
                                <?php if ($admin['email'] == $ADMIN['email']) { ?>
                                    <td class="text-info"><?= $ADMIN['email']; ?></td>
                                <?php } else { ?>
                                    <td><?= $ADMIN['email']; ?></td>
                                <?php } ?>
                                <?php if ($admin['created_at'] == $ADMIN['created_at']) { ?>
                                    <td class="text-info"><?= $ADMIN['created_at']; ?></td>
                                <?php } else { ?>
                                    <td><?= $ADMIN['created_at']; ?></td>
                                <?php } ?>
                                <td><?= $ADMIN['is_super']; ?></td>
                                <td>
                                    <?php if ($admin['is_super'] == "yes") { ?>
                                        <?php if ($ADMIN['is_super'] !== "yes") { ?>
                                            <a class="btn btn-sm btn-danger" href="<?= AURL; ?>handlers/remove-admin.php?id=<?= $ADMIN['id'] ?>">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        <?php } ?>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <?php require_once("inc/footer.php"); ?>