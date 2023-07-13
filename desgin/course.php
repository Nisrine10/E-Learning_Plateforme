
<!DOCTYPE html>
<?php

//refer to Connexion page 
include 'Connecting/connect.php';

if(isset($_COOKIE['user_id1'])){
   $user_id = $_COOKIE['user_id1'];
}else{
   $user_id = '';
header("Location:loginT.php");
}

if(isset($_POST['submit'])){

  $id_E=$_POST['id_user'];
 $id_cours = $_POST['id_get'];
    
    
    $sql = "INSERT INTO `inscription`(`id_cours_CoursSoutien`, `id_eleve_Eleve`) VALUES ('$id_cours','$user_id')";
      mysqli_query($mysqli, $sql);
      move_uploaded_file($thumb_tmp_name, $thumb_folder);
     
      $message[] = 'new course uploaded!';
   

   header("Location:paiement.php");
exit;

   

}

if(isset($_POST['delete'])){
  $get_id=$_POST['cours_id'];
  //deleting the row from table
$result = mysqli_query($mysqli, "DELETE FROM courssoutien WHERE id_cours=$get_id");
$message[]="Course deleted!";
 echo '<div class="message">
      <span><?php'.$message.'?></span>
      <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
    </div>';
//redirecting to the display page (index.php in our case)
header("Location:Courses.php");


}

 if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   
}






  
// partie video
    $stql2="SELECT * FROM document WHERE type_doc like 'video' LIMIT 1";

    $result2=mysqli_query($mysqli,$stql2);



    

    $stql1="SELECT id_eleve,nom_eleve,prenom_eleve,photo_eleve FROM eleve where id_eleve = $user_id";
    


    //retreive data from DataBase
  
    
      
      $result1=mysqli_query($mysqli,$stql1);
  
  
      while($res = mysqli_fetch_array($result1)){
      $id_eleve=$res['id_eleve'];
      $nom=$res['nom_eleve'];
      $prenom=$res['prenom_eleve'];
      $photo=$res['photo_eleve'];
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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Playlists</title>

    <!-- font awesome cdn link  -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    />

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/admin_style.css" />
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
<section class="playlist-details">

   <h1 class="heading">playlist details</h1>

   <?php  
   
   $stql4="SELECT * FROM courssoutien WHERE id_cours=$get_id";

    $result4=mysqli_query($mysqli,$stql4);

     while($res = mysqli_fetch_array($result4)){
   
    $titre=$res['titre_cours'];
    $niveau=$res['niveau'];
    $photoC=$res['photo'];
    $status=$res['status'];
    $description=$res['description'];
    $total_c=mysqli_num_rows($result4);
    }
     ?>

      <div class="row">
      <div class="thumb">
         <span>Total courses:<?= $total_c ?></span>
         <img src="fichier/<?php echo $photoC ?>" alt="">
      </div>
      <div class="details">
         <h3 class="title"><?php echo $titre ?></h3>
         <div class="description"><?php echo $description ?></div>
  <form action="" method="post" >
    <input name="id_user" type="hidden" value="<?php echo $id_user  ?>">
        <input name="id_get" type="hidden" value="<?php echo $get_id ?>">

      <input type="submit" value="add Course" name="submit" class="btn">
  </form>
      </div>
              

   </div>
   
</section>

<!-- video -->

<section class="contents">

   <h1 class="heading">playlist videos</h1>


   <div class="box-container ">


 <?php 
    
    if ($result2->num_rows > 0) {
    // output data of each row
    while($row = $result2->fetch_assoc()) {
     $id_doc=$row['id_doc'];
    $libelle_doc=$row['libelle_doc'];
    $type_doc=$row['type_doc'];
    $date=$row['dateDepot'];
    $status=$row['status'];
    $video=$row['pieceJoint'];
    $photo1=$row['photo'];

   //count
   
    $total_course=mysqli_num_rows($result2);
    

    ?>
        <div class="box">
            <div class="flex">
            <div><i class="fas fa-calendar"></i><span><?= $date; ?></span></div>

            </div>
            <img src="fichier/<?php echo $photo1; ?>" class="thumb" alt="<?php echo $photo1; ?>">
            <h3 class="title"><?php $libelle_doc ?></h3>
           
            <a href="view_video.php?get_id=<?= $id_doc; ?>" class="btn">watch video</a>
        </div>
        <?php
                }
            }else{
                echo '<p class="empty">no videos added yet! <a href="add_content.php" class="btn" style="margin-top: 1.5rem;">add videos</a></p>';
            }
        ?>
 

        </div>


















<footer class="footer">

   © copyright @ 2023 by <span>mr. web designer</span> | all rights reserved!

</footer>
<script src="js/admin_script.js"></script>


</html>