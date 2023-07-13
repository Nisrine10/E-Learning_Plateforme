
<!DOCTYPE html>
<?php

//refer to Connexion page 
include '../Connecting/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
header("Location:loginT.php");
}

if(isset($_POST['delete_video'])){
  $get_id=$_POST['id_doc'];
  //deleting the row from table
$delete = mysqli_query($mysqli, "DELETE FROM contenu WHERE id_doc_Document=$get_id ");

$result = mysqli_query($mysqli, "DELETE FROM document WHERE id_doc=$get_id ");

$message[]="Course deleted!";

//redirecting to the display page (index.php in our case)
//header("Location:view_course.php");


}

 if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   
}





  //retreive data from DataBase

   $stql="SELECT id_formateur,nom_formateur,prenom_formateur,photoF,specialite FROM formateur WHERE id_formateur = $user_id";
    
    $result=mysqli_query($mysqli,$stql);


    while($res = mysqli_fetch_array($result)){
    $id_for=$res['id_formateur'];
    $nom=$res['nom_formateur'];
    $prenom=$res['prenom_formateur'];
    $photo=$res['photoF'];
    $matiere=$res['specialite'];
    }


// partie video
    $stql2="SELECT * FROM document WHERE type_doc like 'video' and id_doc IN (
      SELECT id_doc_Document from contenu WHERE id_cours_CoursSoutien=$get_id
    ) ";

    $result2=mysqli_query($mysqli,$stql2);

// partie document

    $stql1="SELECT * FROM document WHERE type_doc like 'file' and id_doc IN (
      SELECT id_doc_Document from contenu WHERE id_cours_CoursSoutien=$get_id
    ) ";

    $result1=mysqli_query($mysqli,$stql1);

// partie live

    $stql3="SELECT * FROM visio_conference WHERE  id_cours_CoursSoutien = $get_id";

    $result3=mysqli_query($mysqli,$stql3);

    



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
    <link rel="stylesheet" href="../css/admin_style.css" />
  </head>
  <body data-new-gr-c-s-check-loaded="14.1093.0" data-gr-ext-installed="">
    

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
<section class="playlist-details">

   <h1 class="heading">Cours details</h1>

   <?php  $stql4="SELECT * FROM courssoutien WHERE id_cours=$get_id";

    $result4=mysqli_query($mysqli,$stql4);

     while($res = mysqli_fetch_array($result4)){
   
    $titre=$res['titre_cours'];
    $niveau=$res['niveau'];
    $photoC=$res['photo'];
    $status=$res['status'];
    $description=$res['description'];
    $total_course=mysqli_num_rows($result4);
    } ?>

      <div class="row">
      <div class="thumb">
         <span>Total courses:<?= $total_course ?></span>
         <img src="../fichier/<?php echo $photoC ?>" alt="">
      </div>
      <div class="details">
         <h3 class="title"><?php echo $titre ?></h3>
         
         <div class="description"><?php echo $description ?></div>
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="course_id" value="<?=$get_id ?>">
            <a href="update_course.php?get_id=<?=$get_id ?>" class="option-btn">update playlist</a>
            <input type="submit" value="delete Cours" class="delete-btn" onclick="return confirm('delete this playlist?');" name="delete">
            
         </form>
        <div style="margin-right:160px"> <a href="add_doc.php" class="option-btn" style="margin: 10.5rem;">add document</a></div>
      </div>
              

   </div>
   
</section>

<!-- video -->

<section class="contents">

   <h1 class="heading">Cours videos</h1>


   <div class="box-container ">

<!-- video -->

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

   
    $total_course=mysqli_num_rows($result2);
    

    ?>
        <div class="box">
            <div class="flex">
            <div><i class="fas fa-calendar"></i><span><?= $date; ?></span></div>

            </div>
            <img src="../fichier/<?php echo $photo1; ?>" class="thumb" alt="<?php echo $photo1; ?>">
            <h3 class="title"><?= $libelle_doc ?></h3>
            <form action="" method="post" class="flex-btn">
                <input type="hidden" name="id_doc" value="<?= $id_doc; ?>">
                <a href="update_content.php?get_id=<?= $id_doc; ?>" class="option-btn">update</a>
                <input type="submit" value="delete" class="delete-btn" onclick="return confirm('delete this video?');" name="delete_video">
            </form>
            <a href="view_video.php?get_id=<?= $id_doc; ?>" class="btn">watch video</a>
        </div>
        <?php
                }
            }else{
                echo '<p class="empty">no videos added yet! <a href="add_doc.php" class="btn" style="margin-top: 1.5rem;">add videos</a></p>';
            }
        ?>
 

        </div>



</section>

<!-- files -->

<section class="contents ">

   <h1 class="heading">Cours files</h1>

   <div class="box-container ">

        <?php 
        
        if ($result1->num_rows > 0) {
    // output data of each row
    while($row = $result1->fetch_assoc()) {
     $id_doc1=$row['id_doc'];
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
                <input type="hidden" name="id_doc" value="<?= $id_doc1; ?>">
                
                <input type="submit" value="delete" class="delete-btn" onclick="return confirm('delete this video?');" name="delete_video">
            </form>
            <a href="view_video.php?get_id=<?= $id_doc1; ?>" class="btn">Download File</a>
        </div>
       
         <?php
                }
            }else{
                echo '<p class="empty">no file added yet! <a href="add_doc.php" class="btn" style="margin-top: 1.5rem;">add File</a></p>';
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
<script src="../js/admin_script.js"></script>


<scribe-shadow id="shadow-root-scribe-elem" style="position: fixed; width: 0px; height: 0px; top: 0px; left: 0px; z-index: 2147483647; overflow: visible;"></scribe-shadow></body><grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration></html>