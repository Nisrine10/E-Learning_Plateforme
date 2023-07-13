<?php

   include '../Connecting/connect.php';

   setcookie('user_id1', '', time() - 1, '/');

   header('location:../homeWLog.php');

?>