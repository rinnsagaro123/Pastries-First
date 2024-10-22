<?php
session_start();
ob_start();
session_unset();
session_destroy();

include 'components/config.php';

header('location:../home.php');
ob_end_flush();


?>