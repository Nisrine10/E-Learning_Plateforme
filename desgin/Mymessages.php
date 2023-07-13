<!DOCTYPE html>

<?php 
include 'Connecting/connect.php';







if(isset($_COOKIE['user_id1'])){
   $user_id = $_COOKIE['user_id1'];
}else{
   $user_id = '';
header("Location:login.php");
}




if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
   }else{
   $get_id = '';
   }




   


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
   <section class="comments">

 

   <h1 class="heading">Messages</h1>

   
   <div class="show-comments">
      <?php
         $stqlM="SELECT * FROM message GROUP BY id_eleve_Eleve  HAVING COUNT(*)>0 And id_eleve_Eleve=$user_id";
    
    $resultM=mysqli_query($mysqli,$stqlM);

        if ($resultM->num_rows > 0) {
      
    // output data of each row
    while($row = $resultM->fetch_assoc()) {
    $id_msg=$row['id_message'];
    $date_envoi=$row['date_envoi'];
    $date_recoi=$row['date_reçoit'];
    $contenu=$row['contenu'];
    $fichier_joint=$row['fichier_joint'];
    $type_impE=$row['type_implicationElv_envoyer'];
   $type_impF=$row['type_implicationForm_envoi'];
   $id_eleve_Eleve=$row['id_eleve_Eleve'];
   $id_formateur_Formateur=$row['id_formateur_Formateur'];

       $stqlF="SELECT * FROM formateur Where id_formateur = $id_formateur_Formateur";
          $resultF=mysqli_query($mysqli,$stqlF);
          while($res = mysqli_fetch_array($resultF)){
            
               $nomF=$res['nom_formateur'];
               $prenomF=$res['prenom_formateur'];
               $photoF=$res['photoF'];
               $matiereF=$res['specialite'];
         }

      
     


   

      ?>
      <div class="box" style="<?php if($id_formateur_Formateur == $get_id){echo 'order:-1;';} ?>">
        <div class="user">
            <img src="fichier/<?=$photoF?>" alt="">
            <div>
               <h3><?= $nomF ?>  <?= $prenomF?></h3>
                <a href="message.php?eleve_id=<?= $id_formateur_Formateur ?>" class="btn">View Messages</a>
            </div>
         </div>
       
         <hr class="divider">

      </div>
      <?php
       }
      }else{
         echo '<p class="empty">no message added yet!</p>';
      }
      ?>
      </div>
<!-- downlowd -->

      

      <!-- Send -->

  




<script src="js/admin_script.js"></script>

</body>
</html>