<?php 
$title = 'Edit User';
ob_start();
?>

<h2>Edit User</h2>
<form action="index.php?page=users&id=<?=$user['id']?>&action=update" method="post">
  <div class="mb-3">
    <label for="login" class="form-label">Login</label>
    <input type="text" class="form-control" id="login" name="login" value="<?=$user['login']?>">
  </div>
  <div class="mb-3 form-check">
      <label class="form-check-label" for="admin">Admin</label>
        <?php if($user['is_admin']): ?>
            <input type="checkbox" class="form-check-input" id="admin" name="is_admin" value="1" checked>
        <?php else: ?>
            <input type="checkbox" class="form-check-input" id="admin" name="is_admin" value="1">
        <?php endif; ?>
  </div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php 
$content = ob_get_clean();
include "app/views/layout.php";

?>
