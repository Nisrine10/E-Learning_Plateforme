
<!DOCTYPE html>
<?php

//refer to Connexion page 


 include_once("../Connecting/connect.php");

 //get user id

    if(isset($_COOKIE['user_id'])){
      $user_id = $_COOKIE['user_id'];
    }else{
      $user_id = '';
      header("Location:loginT.php");
    }
  //retreive data from DataBase

   $stql="SELECT nom_formateur,prenom_formateur,photoF,specialite FROM formateur Where id_formateur = $user_id";
    
    $result=mysqli_query($mysqli,$stql);


    while($res = mysqli_fetch_array($result)){
    $nom=$res['nom_formateur'];
    $prenom=$res['prenom_formateur'];
    $photo=$res['photoF'];
    $matiere=$res['specialite'];
    
  
    }


    $stql1="SELECT COUNT(*) FROM courssoutien Where id_formateur_Formateur= $user_id";
    
    $result1=mysqli_query($mysqli,$stql1);


    while($res = mysqli_fetch_array($result1)){
  
    $TotalC=$res['COUNT(*)'];
    }


         $stqlM="SELECT COUNT(*) FROM message WHERE id_formateur_Formateur= $user_id";
          $resultM=mysqli_query($mysqli,$stqlM);
          while($res = mysqli_fetch_array($resultM)){
            $TotalM=$res['COUNT(*)'];
          }

              $stqlR="SELECT COUNT(*) FROM reclamation WHERE id_formateur_Formateur= $user_id";
          $resultR=mysqli_query($mysqli,$stqlR);
          while($res = mysqli_fetch_array($resultR)){
            $TotalR=$res['COUNT(*)'];
          }


?>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile</title>

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
    <section class="tutor-profile" style="min-height: calc(100vh - 19rem)">
      <h1 class="heading">profile details</h1>

      <div class="details">
        <div class="tutor">
         <img
          src="../fichier/<?php if($photo != null)echo $photo; else echo 'null.jpg'?>"
          class="image"
          alt="<?php echo $photo; ?>"
        />
          <h3><?php  echo $nom ." ".$prenom?></h3>
          <span><?php echo $matiere ?></span>
          <a href="update.php" class="inline-btn">update profile</a>
        </div>
        <div class="flex">
          <div class="box">
            <span><?= $TotalM ?></span>
            <p>MailBox</p>
            <a href="Mymessages.php" class="btn">view Messages</a>
          </div>
          <div class="box">
            <span><?= $TotalR ?></span>
            <p>Reclamation</p>
            <a href="reclamation.php" class="btn">view Reclamation</a>
          </div>
          <div class="box" style="height: 170px;">
            
            <a href="paiement.php" class="btn" style="margin-top: 50px;">Add new Course</a>
          </div>
          <div class="box">
            <span><?= $TotalC ?></span>
            <p>Courses</p>
            <a href="Courses.php" class="btn">view Courses</a>
          </div>
        </div>
      </div>
    </section>

    <footer class="footer">
      © copyright @ 2023 by <span>mr. web designer</span> | all rights reserved!
    </footer>
    <script src="../js/admin_script.js"></script>
  </body>
</html>
