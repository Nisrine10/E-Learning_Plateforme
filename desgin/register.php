<?php

include 'Connecting/connect.php';

if(isset($_COOKIE['user_id1'])){
   $user_id = $_COOKIE['user_id1'];
}else{
   $user_id = '';
}

if(isset($_POST['submit'])){


   $name = $_POST['name'];

   $surname = $_POST['prenom'];

   $email = $_POST['email'];

 
   $date = "'".date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $_POST['dtn'])))."'";

   $niveau = $_POST['niveau'];

   $pass = sha1($_POST['pass']);
   
   $cpass = sha1($_POST['cpass']);
   

   $image = $_FILES['image']['name'];
 
  
 
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'fichier/'.$image;

   $msg = "SELECT * FROM `eleve` WHERE email_eleve = '$email'";
   

     $select = mysqli_query($mysqli, $msg);
 $row = $select->fetch_assoc();
   
   if(($select->num_rows > 0)){
      $message[] = 'email already taken!';
   
   }else{
      if($pass != $cpass){

           $message[] = 'confirm passowrd not matched!';
    

         }else{

           $sql = "INSERT INTO `eleve`(nom_eleve,prenom_eleve,dtn_eleve, mdp_eleve,niveauEtude, photo_eleve, email_eleve) VALUES('$name','$surname',$date,'$cpass','$niveau','$image','$email')";
    mysqli_query($mysqli, $sql);

         move_uploaded_file($image_tmp_name, $image_folder);
         
         $msg=("SELECT * FROM `eleve` WHERE email_eleve = '$email' LIMIT 1");

     $select = mysqli_query($mysqli, $msg);
 $row = $select->fetch_assoc();
   
   if(($select->num_rows > 0)){
            setcookie('user_id1', $row['id_eleve'], time() + 60*60*24*30, '/');
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
   <link rel="stylesheet" href="css/style1.css">

</head>
<body>
  <!-- header start -->
    <header class="header">
      <section class="flex">
        <a href="home.html" class="logo">Etudiant</a>

        <form action="search.html" method="post" class="search-form">
          <input
            type="text"
            name="search_box"
            required
            placeholder="search courses..."
            maxlength="100"
          />
          <button type="submit" class="fas fa-search"></button>
        </form>

        <div class="icons">
          <div id="menu-btn" class="fas fa-bars"></div>
          <div id="search-btn" class="fas fa-search"></div>
          <div id="user-btn" class="fas fa-user"></div>
          <div id="toggle-btn" class="fas fa-sun"></div>

          
        </div>

        <div class="profile">
          <img src="fichier/<?php if($photo != null)echo $photo; else echo 'null.jpg'?>" class="image" alt="test" />
          <h3 class="name"><?php echo $nom;?></h3>
          <p class="role">eleve</p>
          <a href="profile.html" class="btn">view profile</a>
           <a href="composant/user_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
         
        </div>
      </section>
    </header>
<!-- navbar start -->
    <div class="side-bar">
      

      <div class="profile">
        <img src="fichier/<?php if($photo != null)echo $photo; else echo 'null.jpg'?>" class="image" alt="<?php echo $photo; ?>" />
        <h3 class="name"><?php  echo $nom ." ".$prenom?></h3>
        <p class="role">Etudiant</p>
        <a href="profile.html" class="btn">view profile</a>
      </div>

      <nav class="navbar">
      <a href="homeLog.php"><i class="fas fa-home"></i><span>home</span></a>
      <a href="courses.php"><i class="fas fa-graduation-cap"></i><span>courses</span></a>
      <a href="MyCourses1.php"><i class="fas fa-chalkboard-user"></i><span>My courses</span></a>
      <a href="about.html"><i class="fas fa-question"></i><span>about</span></a>
      <a href="complaint.php"><i class="fa-solid fa-note-sticky"></i><span>complaint</span></a>
      <a href="newmsg.php"><i class="fas fa-headset"></i><span>Send Message</span></a>
   </nav>
    </div>
   <!-- navbar finish -->
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
              <p>your Level <span>*</span></p>
            <input type="text" name="niveau" placeholder="enter your level" maxlength="20" required class="box">
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
      <p class="link">already have an account? <a href="login.php">login now</a></p>
      <input type="submit" name="submit" value="register now" class="btn">
   </form>

</section>







<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>