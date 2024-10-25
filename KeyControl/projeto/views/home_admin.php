<?php 
   session_start();
   
   if (!isset($_SESSION['user_id'])) {
       header("Location: ../app/controllers/verifica_loginadmin.php");
       exit();
   }

   echo"oi";
   
?>