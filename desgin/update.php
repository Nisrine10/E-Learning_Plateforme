<!DOCTYPE html>

<?php 
include 'Connecting/connect.php';

if(isset($_COOKIE['user_id1'])){
   $user_id = $_COOKIE['user_id1'];
}else{
   $user_id = '';
header("Location:loginT.php");
}

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
   }else{
   $get_id = '';
   }

$stql="SELECT id_eleve,nom_eleve,prenom_eleve,photo_eleve,email_eleve FROM eleve WHERE id_eleve=$user_id";
 
 $result=mysqli_query($mysqli,$stql);

 while($res = mysqli_fetch_array($result)){
  
   $id_eleve=$res['id_eleve'];
   $nom=$res['nom_eleve'];
   $prenom=$res['prenom_eleve'];
   $photo=$res['photo_eleve'];
   $email=$res['email_eleve'];
   }

   /*update bouton */ 
   if(isset($_POST['submit'])){

        $nom = $_POST['name'];
        $prenom=$_POST['surname'];
        $email = $_POST['email'];
        $mdp=sha1($_POST['new_pass']);
        
    
       $thumb = $_FILES['image']['name'];
       
      
       $thumb_size = $_FILES['image']['size'];
       $thumb_tmp_name = $_FILES['image']['tmp_name'];
       $thumb_folder = 'fichier/'.$thumb;
    
    
       if($thumb_size > 2000000){
          $message[] = 'image size is too large!';
       }else{
        
        $sql = "UPDATE `eleve` SET `nom_eleve`='$nom',`prenom_eleve`='$prenom',`mdp_eleve`='$mdp',`photo_eleve`='$thumb',`email_eleve`='$email' WHERE id_eleve = $user_id";
          mysqli_query($mysqli, $sql);
          move_uploaded_file($thumb_tmp_name, $thumb_folder);
         
          $message[] = 'new course uploaded!';

          header("Location:profile.php");
       }
      }
    


?>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

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

   <form action="" method="post" enctype="multipart/form-data">
      <h3>update profile</h3>
      <p>update surname</p>
      <input type="text" name="surname" value="<?=$prenom?>" maxlength="50" class="box">
      <p>update name</p>
      <input type="text" name="name" value="<?=$nom?>" maxlength="50" class="box">
      <p>update email</p>
      <input type="email" name="email" value="<?=$email?>" maxlength="50" class="box">
      <p>previous password</p>
      <input type="password" name="old_pass" placeholder="enter your old password" maxlength="20" class="box">
      <p>new password</p>
      <input type="password" name="new_pass" placeholder="enter your new password" maxlength="20" class="box">
      <p>confirm password</p>
      <input type="password" name="c_pass" placeholder="confirm your new password" maxlength="20" class="box">
      <p>update pic</p>
      <input type="file" accept="image/*" name="image" class="box">
      <input type="submit" value="update profile" name="submit" class="btn">
   </form>

</section>















<footer class="footer">

   &copy; copyright @ 2022 by <span>IQ Learn</span> | all rights reserved!

</footer>

<!-- custom js file link  -->
<script src="js/script.js"></script>

   
</body>
</html>