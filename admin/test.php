<?php
require_once('inc/header.php');

use MazadEgypt\Classes\Models\Contact;

$co = new Contact;
$contacts = $co->selectAll();
?>
<div class="container-fluid py-5">
    <div class="row">
        <div class="col-md-10 offset-md-1">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>All Messages</h3>

            </div>

            <form action="" method="GET">
                <div class="form-group">
                    <label>Search</label>
                    <input class="form-control" placeholder="Search Message Or User ..." type="text" name="keyword">
                </div>
            </form>

            <?php if ($request->getHas("keyword")) {
                $keyword = $request->get("keyword");
                $searched = $co->selectWhere("username LIKE '%$keyword%' OR message LIKE '%$keyword%'");
            ?>

                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Name</th>
                            <th scope="col">Message</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($searched as $index => $search) { ?>
                            <tr>
                                <th scope="row"><?= $index + 1 ?></th>
                                <td><?= $search['username']; ?></td>
                                <td><?= $search['message']; ?></td>
                                <td><?= $search['created_at']; ?></td>
                                <td>
                                    <a class="btn btn-sm btn-danger" href="<?= AURL; ?>handlers/delete-message.php?id=<?= $search['id']; ?>">
                                        <i title="Delete Message" class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            
                        <?php } ?>

                    </tbody>

                <?php } else { ?>

                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Name</th>
                                <th scope="col">Message</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($contacts as $index => $contact) { ?>

                                <tr>
                                    <th scope="row"><?= $index + 1 ?></th>
                                    <td><?= $contact['username']; ?></td>
                                    <td><?= $contact['message']; ?></td>
                                    <td><?= $contact['created_at']; ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-danger" href="<?= AURL; ?>handlers/delete-message.php?id=<?= $contact['id']; ?>">
                                            <i title="Delete Message" class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                            <?php } ?>

                        </tbody>
                    </table>

                <?php } ?>

        </div>
    </div>
</div>
<?php require_once("inc/footer.php"); ?>