<?php
require_once('inc/header.php');

use MazadEgypt\Classes\Models\Profit;

use function PHPSTORM_META\type;

$pf = new Profit;
$profits = $pf->selectAll();
?>
<div class="container-fluid py-5">
    <div class="row">
        <div class="col-md-10 offset-md-1">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>All Profits</h3>
            </div>

            <form>
                <div class="form-group">
                    <input class="form-control" placeholder="Search Auction Name Profits ..." type="text" name="keyword">
                </div>
            </form>

            <?php if ($request->getHas("keyword")) {
                $keyword = $request->get("keyword");
                $searched = $pf->selectWhere("auction_name LIKE '%$keyword%'");
            ?>
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Auction Name</th>
                            <th scope="col">Profit</th>
                            <th scope="col">Submitted At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($searched as $index => $search) { ?>
                            <tr>
                                <th scope="row"><?= $index + 1 ?></th>
                                <td><?= $search['auction_name']; ?></td>
                                <td><?= $search['profit'] . " L.E"; ?></td>
                                <td><?= $search['created_at']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>

                <?php } else { ?>

                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Auction Name</th>
                                <th scope="col">Profit</th>
                                <th scope="col">Submitted At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($profits as $index => $profit) { ?>
                                <tr>
                                    <th scope="row"><?= $index + 1 ?></th>
                                    <td><?= $profit['auction_name']; ?></td>
                                    <td><?= $profit['profit'] . " L.E"; ?></td>
                                    <td><?= $profit['created_at']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    <?php } ?>
                    </table>
        </div>

    </div>
</div>
<?php require_once("inc/footer.php"); ?>