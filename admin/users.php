<?php

use MazadEgypt\Classes\Models\User;

require_once('inc/header.php');
$us = new User;
$users = $us->selectAll();
?>
<div class="container-fluid py-5">
    <div class="row">
        <div class="col-md-10 offset-md-1">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>All Users</h3>

            </div>


            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Created At</th>
                        <?php if ($admin['is_super'] == "yes") { ?>
                            <th scope="col">Actions</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $index => $user) { ?>
                        <tr>
                            <th scope="row"><?= $index + 1 ?></th>
                            <td><?= $user['name']; ?></td>
                            <td><?= $user['email']; ?></td>
                            <td><?= $user['address']; ?></td>
                            <td><?= $user['phone']; ?></td>
                            <td><?= $user['created_at']; ?></td>
                            <td>
                                <?php if ($admin['is_super'] == "yes") { ?>
                                    <a class="btn btn-sm btn-danger" href="<?= AURL; ?>handlers/remove-user.php?id=<?= $user['id'] ?>">
                                        <i class="fas fa-trash"></i>
                                    </a>
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