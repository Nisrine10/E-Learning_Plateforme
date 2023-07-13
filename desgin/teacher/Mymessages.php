<!DOCTYPE html>

<?php 
include '../Connecting/connect.php';


if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
header("Location:loginT.php");
}




   
  $stql="SELECT id_formateur,nom_formateur,prenom_formateur,photoF,specialite FROM formateur WHERE id_formateur = $user_id";
    
    $result=mysqli_query($mysqli,$stql);


    while($res = mysqli_fetch_array($result)){
    $id_for=$res['id_formateur'];
    $nom=$res['nom_formateur'];
    $prenom=$res['prenom_formateur'];
    $photo1=$res['photoF'];
    $matiere=$res['specialite'];
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
            src="../fichier/<?php if($photo1 != null)echo $photo1; else echo 'null.jpg'?>"
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
          src="../fichier/<?php if($photo1 != null)echo $photo1; else echo 'null.jpg'?>"
          class="image"
          alt="<?php echo $photo1; ?>"
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


   <section class="comments">

 

   <h1 class="heading">Messages</h1>

   
   <div class="show-comments">
      <?php
         $stqlM="SELECT * FROM message GROUP BY id_eleve_Eleve  HAVING COUNT(*)>0 AND  id_formateur_Formateur = $user_id";
    
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

       $stqlE="SELECT * FROM eleve Where id_eleve = $id_eleve_Eleve";
          $resultE=mysqli_query($mysqli,$stqlE);
          while($res = mysqli_fetch_array($resultE)){
            
               $nomE=$res['nom_eleve'];
               $prenomE=$res['prenom_eleve'];
               $photoE=$res['photo_eleve'];
               $matiereE=$res['email_eleve'];
         }

   

      ?>
      <div class="box" >
        <div class="user">
            <img src="../fichier/<?=$photoE?>" alt="">
            <div>
               <h3><?= $nomE ?>  <?= $prenomE?></h3>
              <a href="message.php?get_id=<?= $id_eleve_Eleve ?>" class="btn">View Messages</a>
               
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

  




<script src="../js/admin_script.js"></script>

</body>
</html>