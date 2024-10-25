<?php
session_start();

$_SESSION = array();

session_destroy();

header('Location: ../../views/login_superior.html');
exit();
?>
