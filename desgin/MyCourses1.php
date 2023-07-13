
<!DOCTYPE html>
<?php

//refer to Connexion page 
include 'Connecting/connect.php';
if(isset($_COOKIE['user_id1'])){
   $user_id = $_COOKIE['user_id1'];
}else{
   $user_id = '';
header("Location:login.php");
}


if(isset($_POST['delete'])){
  $get_id=$_POST['cours_id'];
  //deleting the row from table
$result = mysqli_query($mysqli, "DELETE FROM courssoutien WHERE id_cours=$get_id");
$message="Course deleted!";
 
//redirecting to the display page (index.php in our case)



}


   
$stql1="SELECT id_eleve,nom_eleve,prenom_eleve,photo_eleve FROM eleve Where id_eleve =$user_id ";
    





  //retreive data from DataBase

  
    
    $result1=mysqli_query($mysqli,$stql1);


    while($res = mysqli_fetch_array($result1)){
    $id_eleve=$res['id_eleve'];
    $nom=$res['nom_eleve'];
    $prenom=$res['prenom_eleve'];
    $photo1=$res['photo_eleve'];
    }


  //retreive data from DataBase


    $stql2="SELECT * FROM courssoutien WHERE id_cours IN (
      SELECT id_cours_CoursSoutien FROM inscription WHERE id_eleve_Eleve = $user_id
    )";

    $result2=mysqli_query($mysqli,$stql2);

     while($res = mysqli_fetch_array($result2)){
   
    $titre=$res['titre_cours'];
    $niveau=$res['niveau'];
    $photo=$res['photo'];
    $status=$res['status'];
    $description=$res['description'];
    }


  
   

$result3 = $mysqli->query($stql2);


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
    <title>Courses</title>

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
        <img src="fichier/<?php if($photo1 != null)echo $photo1; else echo 'null.jpg'?>" class="image" alt="<?php echo $photo; ?>" />
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
    <section class="playlists">
      <h1 class="heading">added courses</h1>

      <div class="box-container">
        
<?php 
    
    if ($result1->num_rows > 0) {
      
    // output data of each row
    while($row = $result3->fetch_assoc()) {
    $id_cours=$row['id_cours'];
    $titre=$row['titre_cours'];
    $niveau=$row['niveau'];
    $photo=$row['photo'];
    $status=$row['status'];
    $description=$row['description'];

   
    $total_course=mysqli_num_rows($result3);
    

    ?>
 


    <div class="box">
         <div class="flex">
             <div><i style=<?php if($row['status'] == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>><?php if($row['status'] == 'active'){echo 'active'; }else{echo 'not active';} ?></i></div>
            
         </div>
         <div class="thumb">
            <span><?= $total_course ?></span>
            
            <img src="fichier/<?= $photo; ?>" alt="<?= $photo; ?>">
         </div>
         <h2 class="niveau"><?= $niveau ?></h2>
         <h3 class="title"><?= $titre; ?></h3>
         <p class="description"><?=  $description ?></p>
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="cours_id" value="<?= $id_cours; ?>">
         </form>
         <a href="view_courses.php?get_id=<?= $id_cours; ?>" class="btn">view Course</a>
      </div>

    
    <?php 
    }
} else {
    echo '<p class="empty">no playlist added yet!</p>';
}
?>
        
      
    </section>

    <footer class="footer">
      © copyright @ 2023 by <span>IQ Learn</span> | all rights reserved!
    </footer>
    <script src="js/admin_script.js"></script>

    <script>
      document
        .querySelectorAll(".playlists .box-container .box .description")
        .forEach((content) => {
          if (content.innerHTML.length > 100)
            content.innerHTML = content.innerHTML.slice(0, 100);
        });
    </script>
  </body>
</html>
