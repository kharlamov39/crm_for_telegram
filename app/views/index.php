<?php
if($_SERVER['REQUEST_URI'] == '/crm_for_telegram/index.php') {
    header('Location: /crm_for_telegram/');
}

$title = 'Home page';
ob_start();
?>
<h2>HOME</h2>

<?php 
$content = ob_get_clean();
include "app/views/layout.php";
?>