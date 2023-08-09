<?php 
$title = 'User list';
ob_start();
?>


<table class="table table-bordered mt-4">
    <a href="index.php?page=users&action=create" class="btn btn-success">Create User</a>
    <thead>
        <tr>
            <th scope="col">$</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Admin</th>
            <th scope="col">Created</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user): ?>
            <tr>
                <td scope="row"><?=$user['id']?></td>
                <td><?=$user['username']?></td>
                <td><?=$user['email']?></td>
                <td><?=$user['is_admin'] ? 'Yes' : 'No'?></td>
                <td><?=$user['created_at']?></td>
                <td>
                    <a href="index.php?page=users&id=<?=$user['id']?>&action=edit" class="btn btn-primary" >Edit</a>
                    <a href="index.php?page=users&id=<?=$user['id']?>&action=delete" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php 
$content = ob_get_clean();
include "app/views/layout.php";

?>