<!DOCTYPE html>
<?php

//refer to Connexion page 

include 'Connecting/connect.php';


   if(isset($_COOKIE['user_id1'])){
      $eleve_id = $_COOKIE['user_id1'];
   }else{
      $tutor_id = '';
      header('location:login.php');
   }


$stql="SELECT count(*) FROM inscription Where id_eleve_Eleve =$eleve_id ";
    
$result=mysqli_query($mysqli,$stql);


while($res = mysqli_fetch_array($result)){
$count=$res['count(*)'];
}


$stql1="SELECT id_eleve,nom_eleve,prenom_eleve,photo_eleve FROM eleve Where id_eleve =$eleve_id ";
    





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
    <title>Profile</title>

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

    


    <section class="tutor-profile" style="min-height: calc(100vh - 19rem)">
      <h1 class="heading">profile details</h1>

      <div class="details">
        <div class="tutor">
         <img
          src="fichier/<?php if($photo != null)echo $photo; else echo 'null.jpg'?>"
          class="image"
          alt="<?php echo $photo; ?>"
        />
          <h3><?php  echo $nom ." ".$prenom?></h3>
          <span><?php echo "Student" ?></span>
          <a href="update.php?get_id=<?= $id_eleve; ?>" class="inline-btn">update profile</a>
        </div>
        <div class="flex">
          
          
          <div class="box">
            <span><?=$count;?></span>
            <p>Courses</p>
            <a href="MyCourses1.php" class="btn">My Courses</a>
          </div>
        

        <div class="box">
            <span>0</span>
            <p>Courses</p>
            <a href="studentdoc.php" class="btn">My Documents</a>
          </div>
        
      </div>
    </section>

    <footer class="footer">
      © copyright @ 2023 by <span>IQ Learn</span> | all rights reserved!
    </footer>
    <script src="js/admin_script.js"></script>
  </body>
</html>
