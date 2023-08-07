<?php 
$title = 'User list';
ob_start();
?>


<table class="table table-bordered mt-4">
    <a href="index.php?page=users&action=create" class="btn btn-success">Create User</a>
    <thead>
        <tr>
            <th scope="col">$</th>
            <th scope="col">Login</th>
            <th scope="col">Admin</th>
            <th scope="col">Created</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user): ?>
            <tr>
                <td scope="row"><?=$user['id']?></td>
                <td><?=$user['login']?></td>
                <td><?=isset($user['is_admin']) ? 'Yes' : 'No'?></td>
                <td><?=$user['created_at']?></td>
                <td>
                    <a href="#">Edit</a>
                    <a href="#">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php 
$content = ob_get_clean();
include "app/views/layout.php";

?>