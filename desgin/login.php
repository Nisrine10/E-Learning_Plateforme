<?php

include 'Connecting/connect.php';




if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
header("Location:login.php");
}


if(isset($_POST['submit'])){

  $email = $_POST['email'];
  
   $pass =sha1( $_POST['password']);
  

   $msg=("SELECT * FROM `eleve` WHERE email_eleve = '$email' AND mdp_eleve = '$pass' LIMIT 1");
   $select = mysqli_query($mysqli, $msg);
   $row = $select->fetch_assoc();
   
     if ($select->num_rows > 0) {
   
    // output data of each row
    
     setcookie('user_id1', $row['id_eleve'], time() + 60*60*24*30, '/');
     header('Location:profile.php');
    
   }else{
      $message[] = 'incorrect email or password!';
      
   }

}

?>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style1.css">

</head>
<body>


 <!-- header -->
  <header class="header">
      <section class="flex">
        <a href="home.html" class="logo">Student</a>

      

        <div class="icons">
          <div id="menu-btn" class="fas fa-bars"></div>
          <div id="search-btn" class="fas fa-search"></div>
          <div id="user-btn" class="fas fa-user"></div>
          <div id="toggle-btn" class="fas fa-sun"></div>

          
        </div>

        <div class="profile">
         <div class="box" style="text-align: center;">
         <h3 class="title">please login or register</h3>
          <div class="flex-btn" style="padding-top: .5rem;">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div>
      </section>
    </header>

    <div class="side-bar">
      

   

      <nav class="navbar">
      <a href="home.html"><i class="fas fa-home"></i><span>home</span></a>
      <a href="about.html"><i class="fas fa-question"></i><span>about</span></a>
     
      <a href="contact.html"><i class="fas fa-headset"></i><span>contact us</span></a>
   </nav>
    </div>
<!-- side bar section ends --> 

<section class="form-container">

   <form action="" method="post" enctype="multipart/form-data" class="login">
      <h3>welcome back!</h3>
      <p>your email <span>*</span></p>
      <input type="email" name="email" placeholder="enter your email" maxlength="50" required class="box">
      <p>your password <span>*</span></p>
      <input type="password" name="password" placeholder="enter your password" maxlength="20" required class="box">
      <p class="link">don't have an account? <a href="register.php">register now</a></p>
      <input type="submit" name="submit" value="login now" class="btn">
   </form>

</section>














<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>