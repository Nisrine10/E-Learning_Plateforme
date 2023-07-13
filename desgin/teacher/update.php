<!DOCTYPE html>

<?php 
include '../Connecting/connect.php';

    if(isset($_COOKIE['user_id'])){
      $user_id = $_COOKIE['user_id'];
    }else{
      $user_id = '';
    header("Location:loginT.php");
    }

   //for header
  $stql="SELECT id_formateur,nom_formateur,prenom_formateur,photoF,specialite,email_formateur FROM formateur WHERE id_formateur = $user_id";
    
    $result=mysqli_query($mysqli,$stql);


    while($res = mysqli_fetch_array($result)){
    $id_for=$res['id_formateur'];
    $nom=$res['nom_formateur'];
    $prenom=$res['prenom_formateur'];
    $photo=$res['photoF'];
    $matiere=$res['specialite'];
    $email=$res['email_formateur'];

    }

   /*update bouton */ 
   if(isset($_POST['submit'])){

        $nom = $_POST['name'];
        $prenom=$_POST['surname'];
        $email = $_POST['email'];
        $mdp=$_POST['new_pass'];
        $cpass=$_POST['c_pass'];


        $date = "'".date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $_POST['date'])))."'";

    
       $thumb = $_FILES['image']['name'];
       
      
       $thumb_size = $_FILES['image']['size'];
       $thumb_tmp_name = $_FILES['image']['tmp_name'];
       $thumb_folder = '../fichier/'.$thumb;
    
    if($mdp != $cpass){

           $message[] = 'confirm password not matched!';
  
         }else{
       if($thumb_size > 2000000){
          $message[] = 'image size is too large!';
       }else{
        
           $update_playlist =mysqli_query($mysqli,$stl ="UPDATE `formateur` SET `nom_formateur`='$nom',`prenom_formateur`='$prenom',`mdp_formateur`='$mdp',`email_formateur`='$email',`photoF`='$thumb',`dtn_formateur`=$date");

          move_uploaded_file($thumb_tmp_name, $thumb_folder);
         
         

          header("Location:profile.php");
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

<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>


    <!-- header -->
  <header class="header">
      <section class="flex">
        <a href="home.html" class="logo">Proffesseur</a>

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
          <img
            src="../fichier/<?php if($photo != null)echo $photo; else echo 'null.jpg'?>"
            class="image"
            alt="test"
          />
          <h3 class="name"><?php  echo $nom ." ".$prenom?></h3>
          <p class="role">Formateur</p>
          <a href="profile.php" class="btn">view profile</a>
                     <a href="..composant/user_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>

        </div>
      </section>
    </header>

    <!-- header section ends -->

    <!-- side bar section starts  -->

    <div class="side-bar">
      

      <div class="profile">
        <img
          src="../fichier/<?php if($photo != null)echo $photo; else echo 'null.jpg'?>"
          class="image"
          alt="<?php echo $photo; ?>"
        />
        <h3 class="name"><?php  echo $nom ." ".$prenom?></h3>
        <p class="role">Proffesseur</p>
        <a href="profile.php" class="btn">view profile</a>
      </div>

      <nav class="navbar">
        <a href="homeLog.php"><i class="fas fa-home"></i><span>home</span></a>
        <a href="about.html"
          ><i class="fas fa-question"></i><span>about</span></a
        >
        <a href="Courses.php"
          ><i class="fas fa-graduation-cap"></i><span>courses</span></a
        >
        <a href="reclamation.php"
          ><i class="fas fa-chalkboard-user"></i><span>Complaint</span></a
        >
        <a href="MyMessages.php"
          ><i class="fas fa-headset"></i><span>Message us</span></a
        >
      </nav>
    </div>

    <!-- side bar section ends -->

<section class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>update profile</h3>
      <p>update surname</p>
      <input type="text" name="surname" value="<?=$prenom?>" maxlength="50" class="box">
      <p>update name</p>
      <input type="text" name="name" value="<?=$nom?>" maxlength="50" class="box">
      <p>update email</p>
      <input type="email" name="email" value="<?=$email?>" maxlength="100" class="box">
       <p>update date de naissance</p>
      <input type="date" name="date" value="<?=$date?>" maxlength="50" class="box">

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
<script src="../js/script.js"></script>

   
</body>
</html>