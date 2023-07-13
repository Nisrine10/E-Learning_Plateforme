
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



 if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   
}

if(isset($_GET['path']))
{
//Read the filename
$filename = $_GET['path'];
//Check the file exists or not
if(file_exists($filename)) {

//Define header information
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: 0");
header('Content-Disposition: attachment; filename="'.basename($filename).'"');
header('Content-Length: ' . filesize($filename));
header('Pragma: public');

//Clear system output buffer
flush();

//Read the size of the file
readfile($filename);

//Terminate from the script
die();

$get_id= $_GET['eleve_id'];

header("Location:view_courses.php?eleve_id=.'$get_id'");
}

}





  
// partie video
     $stql2="SELECT * FROM document WHERE type_doc like 'video' and id_doc IN (
      SELECT id_doc_Document from contenu WHERE id_cours_CoursSoutien=$get_id
    ) ";

    $result2=mysqli_query($mysqli,$stql2);


// partie document

 $stql5="SELECT * FROM document WHERE type_doc like 'file' and id_doc IN (
      SELECT id_doc_Document from contenu WHERE id_cours_CoursSoutien=$get_id
    ) ";

$result5=mysqli_query($mysqli,$stql5);

// partie live


    $stql3="SELECT * FROM visio_conference WHERE  id_cours_CoursSoutien = $get_id";

    $result3=mysqli_query($mysqli,$stql3);


    

    $stql1="SELECT id_eleve,nom_eleve,prenom_eleve,photo_eleve FROM eleve WHERE id_eleve = $user_id";
    





    //retreive data from DataBase
  
    
      
      $result1=mysqli_query($mysqli,$stql1);
  
  
      while($res = mysqli_fetch_array($result1)){
      $id_eleve=$res['id_eleve'];
      $nom=$res['nom_eleve'];
      $prenom=$res['prenom_eleve'];
      $photo=$res['photo_eleve'];
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
  <body >
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
          <img src="fichier/<?php if($photo1 != null)echo $photo1; else echo 'null.jpg'?>" class="image" alt="test" />
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
        <img src="fichier/<?php if($photo1 != null)echo $photo; else echo 'null.jpg'?>" class="image" alt="<?php echo $photo1; ?>" />
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
<section class="playlist-details">

   <h1 class="heading">Course details</h1>

   <?php  
   
   $stql4="SELECT * FROM courssoutien WHERE id_cours=$get_id";

   

    $result4=mysqli_query($mysqli,$stql4);

     while($res = mysqli_fetch_array($result4)){
   
    $titre=$res['titre_cours'];
    $niveau=$res['niveau'];
    $photoC=$res['photo'];
    $status=$res['status'];
    $description=$res['description'];
    $id_form = $res['id_formateur_Formateur'];
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
      </div>
      <a class="inline-btn" style="margin-top: 1.5rem;" href="newmsg.php?get_id=<?= $id_form ?>">Send Message to tutor</a>
  

   </div>
   
</section>

<!-- video -->

<section class="contents">

   <h1 class="heading">Course Videos</h1>


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
                echo '<p class="empty">no videos added yet! </p>';
            }
        ?>
 

        </div>





<!-- files -->

<section class="contents ">

   <h1 class="heading">Course Files</h1>

   <div class="box-container ">

        <?php 
        
        if ($result5->num_rows > 0) {
    // output data of each row
    while($row = $result5->fetch_assoc()) {
     $id_do1=$row['id_doc'];
    $libelle_doc1=$row['libelle_doc'];
    $type_doc1=$row['type_doc'];
    $date1=$row['dateDepot'];
    $status1=$row['status'];
    $video1=$row['pieceJoint'];
    $photo2=$row['photo'];

   
    $total_course=mysqli_num_rows($result1);
        

        ?>
       <div class="box">
            <div class="flex">
            <div><i class="fas fa-calendar"></i><span><?= $date1; ?></span></div>

            </div>
            
            <h3 class="title"><?php echo $libelle_doc1 ?></h3>
            <form action="" method="post" class="flex-btn">
                <input type="hidden" name="video_id" value="<?= $id_doc1; ?>">
                
            </form>
           <a class="btn" style="margin-top: 1.5rem;" href="view_courses.php?path=fichier/<?= $video ?>">Download file</a>
        </div>
       
         <?php
                }
            }else{
                echo '<p class="empty">no file added yet! </p>';
            }
        ?>

        </div>



</section>

<!-- live -->
<section class="contents ">

   <h1 class="heading">Cours Live</h1>

   <div class="box-container ">

        <?php 
        
       
         if ($result3->num_rows > 0) {
    // output data of each row
    while($row = $result3->fetch_assoc()) {
     $id_doc2=$row['num_seance'];
    $libelle_doc2=$row['nom_seance'];
    $type_doc2=$row['lien'];
    $date2=$row['date_seance'];
    $status2=$row['duree'];
   

   
    $total_course=mysqli_num_rows($result3);

        ?>
        <div class="box">
            <div class="flex">
                <div><i class="fas fa-dot-circle" style="<?php if($status2 == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"></i><span style="<?php if($status2 == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"><?= $status2; ?></span></div>
            </div>
            <h3></h3>
            <h3 class="title">Title: <?= $libelle_doc2?></h3>
               <h3 class="title">Date: <?= $date2?></h3>
            <form action="" method="post" class="flex-btn">
                <input type="hidden" name="id_doc" value="<?= $id_doc2; ?>">
            </form>
            <a href="<?= $type_doc2?>" class="btn">go to link</a>
        </div>
       
    <?php
                }
            }else{
                echo '<p class="empty">no Live added yet! <a href="live.php" class="btn" style="margin-top: 1.5rem;">add live streaming</a></p>';
            }
        ?>

        </div>



</section>




<footer class="footer">

   © copyright @ 2023 by <span>mr. web designer</span> | all rights reserved!

</footer>
<script src="js/admin_script.js"></script>


</html>