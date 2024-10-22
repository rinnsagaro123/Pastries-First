<?php
ob_start();
session_start();
session_unset();
session_destroy();

include 'config.php';


header('location:../admin/admin_login.php');
ob_end_flush();

?>