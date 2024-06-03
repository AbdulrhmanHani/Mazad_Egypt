<?php
require_once('inc/header.php');

// echo '<pre>';
// print_r($admin);
// echo '</pre>';
?>
<div class="container py-5">
    <div class="row">

        <div class="col-md-6 offset-md-3">
            <h3 class="mb-3">Add Admin</h3>
            <div class="card">
                <div class="card-body p-5">
                    <?php if ($session->has("newAdminErrors")) { ?>
                        <?php foreach ($_SESSION['newAdminErrors'] as $_SESSION['error']) { ?>
                            <!-- css For Abdallah -->
                            <div style="margin-top: 10px;margin-bottom: 15px;text-align: center;font-size: 24px;border: 2px red solid;color: red;background-color: white;width:450px;margin-right:230px"><?= $_SESSION['error'] ?> *</div>
                        <?php } ?>
                    <?php } ?>
                    <?php $session->remove("newAdminErrors"); ?>
                    <?php $session->remove("error"); ?>
                    <form method="POST" action="handlers/add-admin.php">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" placeholder="Name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="Email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Password" class="form-control">
                        </div>

                        <div class="form-group text-center">
                            <label>Set Admin Super</label>
                            <br>
                            <input type="radio" name="super" value="yes" id="yes"> Yes
                            <input class="ml-4" type="radio" name="super" value="no" id="no"> No
                        </div>

                        <div class="text-center mt-5">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            <a class="btn btn-dark" href="<?= AURL . "admins.php"; ?>">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<?php require_once("inc/footer.php"); ?>