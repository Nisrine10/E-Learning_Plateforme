<?php

include '../Connecting/connect.php';


//get cookie

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}


//submit register


if(isset($_POST['submit'])){


   $name = $_POST['name'];

   $surname = $_POST['prenom'];

   $email = $_POST['email'];

 
   $date = "'".date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $_POST['dtn'])))."'";

   $specialite = $_POST['specialite'];

   $pass = sha1($_POST['pass']);
   
   $cpass = sha1($_POST['cpass']);
   

   $image = $_FILES['image']['name'];
 
  
 
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../fichier/'.$image;

   //add new Teacher

   $msg = "SELECT * FROM `formateur` WHERE email_formateur = '$email'";
   $select = mysqli_query($mysqli, $msg);
   $row = $select->fetch_assoc();
   
   if(($select->num_rows > 0)){
      $message[] = 'email already taken!';
    
   }else{
      if($pass != $cpass){

           $message[] = 'confirm passowrd not matched!';
  
         }else{

           $sql = "INSERT INTO `formateur`(nom_formateur,prenom_formateur,dtn_formateur, mdp_formateur,specialite, photoF, email_formateur) VALUES('$name','$surname',$date,'$pass','$specialite','$image','$email')";
            mysqli_query($mysqli, $sql);

            //image
         move_uploaded_file($image_tmp_name, $image_folder);
         
         $msg=("SELECT * FROM `formateur` WHERE email_formateur = '$email' LIMIT 1");

         $select = mysqli_query($mysqli, $msg);
         $row = $select->fetch_assoc();
   
   if(($select->num_rows > 0)){
            setcookie('user_id', $row['id_formateur'], time() + 60*60*24*30, '/');
            header('location:profile.php');
         }
      }
   }

}

?>

<?php
//afficher msg
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
   <link rel="stylesheet" href="../css/style1.css">

</head>
<body>

<!-- header -->
  <header class="header">
      <section class="flex">
        <a href="home.html" class="logo">Proffesseur</a>

      

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
            <a href="loginT.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div>
      </div>
        </div>
      </section>
    </header>

    <!-- header section ends -->

    <!-- side bar section starts  -->

    <div class="side-bar">
     

    

      <nav class="navbar">
        <a href="../homeWLog.php"><i class="fas fa-home"></i><span>home</span></a>
        <a href="about.html"
          ><i class="fas fa-question"></i><span>about</span></a
        >
        <a href="contact.html"
          ><i class="fas fa-headset"></i><span>contact us</span></a
        >
      </nav>
    </div>

    <!-- side bar section ends -->


<section class="form-container">

   <form class="register" action="" method="post" enctype="multipart/form-data">
      <h3>create account</h3>
      <div class="flex">
         <div class="col">
             <p>your surname <span>*</span></p>
            <input type="text" name="prenom" placeholder="eneter your surname" maxlength="50" required class="box">
            <p>your name <span>*</span></p>
            <input type="text" name="name" placeholder="eneter your name" maxlength="50" required class="box">
            <p>your email <span>*</span></p>
            <input type="email" name="email" placeholder="enter your email" maxlength="20" required class="box">
              <p>your profession <span>*</span></p>
            <input type="text" name="specialite" placeholder="enter your profession" maxlength="20" required class="box">
              <p>your Birthday <span>*</span></p>
            <input type="date" name="dtn" placeholder="enter your birthday" maxlength="20" required class="box">
         </div>
         <div class="col">
            <p>your password <span>*</span></p>
            <input type="password" name="pass" placeholder="enter your password" maxlength="20" required class="box">
            <p>confirm password <span>*</span></p>
            <input type="password" name="cpass" placeholder="confirm your password" maxlength="20" required class="box">
         </div>
      </div>
      <p>select pic <span>*</span></p>
      <input type="file" name="image" accept="image/*" required class="box">
      <p class="link">already have an account? <a href="loginT.php">login now</a></p>
      <input type="submit" name="submit" value="register now" class="btn">
   </form>

</section>







<!-- custom js file link  -->
<script src="../js/script.js"></script>
   
</body>
</html>