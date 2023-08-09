<?php 
$title = 'Create User';
ob_start();
?>

<h2>Create User</h2>
<form action="index.php?page=users&action=store" method="post">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username">
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email adress</label>
    <input type="email" class="form-control" id="email" name="email">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <div class="mb-3">
    <label for="confirm" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="confirm" name="confirm_password">
  </div>
  <!-- <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="admin" value="1" name="is_admin">
    <label class="form-check-label" for="admin">Admin</label>
  </div> -->
  <button type="submit" class="btn btn-primary">Create</button>
</form>

<?php 
$content = ob_get_clean();
include "app/views/layout.php";

?>
