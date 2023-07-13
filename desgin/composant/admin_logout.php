<?php

  include '../Connecting/connect.php';

   setcookie('tutor_id', '', time() - 1, '/');

   header('location:../teacher/login.php');

?>