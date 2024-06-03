<?php
require_once('inc/header.php');
?>
<div class="container py-5">
  <div class="row">

    <div class="col-md-6 offset-md-3">
      <h3 class="mb-3">Edit Admin Profile</h3>
      <div class="card">
        <div class="card-body p-5">
          <?php if ($session->has("editAdminErrors")) { ?>
            <?php foreach ($session->get("editAdminErrors") as $error) { ?>
              <div class="my-5 text-center" style="margin-top: 10px;text-align: center;font-size: 24px;border: 2px red solid;color: red;background-color: white;width:450px;margin-right:230px">* <?= $error; ?></div>
            <?php } ?>
            <?php $session->remove("editAdminErrors"); ?>
          <?php } elseif ($session->has("editAdminSuccess")) { ?>
            <div class="my-5" style="margin-top: 10px;text-align: center;font-size: 24px;border: 2px green solid;color: green;background-color: white;width: 400px;"><?= $_SESSION['editAdminSuccess']; ?></div>
          <?php } ?>
          <?php $session->remove("editAdminSuccess"); ?>
          <form method="POST" action="<?= AURL; ?>handlers/edit-admin-profile.php">
            <div class="form-group">
              <label>Edit Name</label>
              <input type="text" name="username" placeholder="<?= $admin['name']; ?>" class="form-control">
            </div>
            <div class="form-group">
              <label>Edit Email</label>
              <input type="email" name="email" placeholder="<?= $admin['email']; ?>" class="form-control">
            </div>
            <div class="form-group">
              <label>Edit Password</label>
              <input type="password" name="password" placeholder="**********" class="form-control">
            </div>
            <div class="text-center mt-5">
              <button type="submit" name="submit" class="btn btn-primary px-4">Update</button>
              <a class="btn btn-dark" href="<?= AURL; ?>">Back</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require_once("inc/footer.php"); ?>