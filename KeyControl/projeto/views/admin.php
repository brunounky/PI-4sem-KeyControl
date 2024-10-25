<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: ../app/controllers/verifica_login.php");
  exit();
}

include '../app/controllers/db_conexao.php';


include 'navbar.php';

?>