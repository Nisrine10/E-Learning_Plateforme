
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

if(isset($_POST['delete'])){
  $get_id=$_POST['cours_id'];

  //deleting the row from table
$result = mysqli_query($mysqli, "DELETE FROM courssoutien WHERE id_cours=$get_id");
$message[]="Course deleted!";
 



}





  //retreive data from DataBase

   $stql="SELECT id_formateur,nom_formateur,prenom_formateur,photoF,specialite FROM formateur WHERE id_formateur = $user_id";
    
    $result=mysqli_query($mysqli,$stql);


    while($res = mysqli_fetch_array($result)){
    $id_for=$res['id_formateur'];
    $nom=$res['nom_formateur'];
    $prenom=$res['prenom_formateur'];
    $photo1=$res['photoF'];
    $matiere=$res['specialite'];
    }

    $stql2="SELECT * FROM courssoutien WHERE id_formateur_Formateur=$user_id";

    $result3 = $mysqli->query($stql2);


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

    <section class="playlists">
      <h1 class="heading">added courses</h1>

      <div class="box-container">
        <div class="box" style="text-align: center">
          <h3 class="title" style="margin-bottom: 0.5rem">
            create new course
          </h3>
          <a href="add_course.php" class="btn">add course</a>
        </div>
<?php 
    
    if ($result3->num_rows > 0) {
      
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
            
            <img src="../fichier/<?= $photo; ?>" alt="<?= $photo; ?>">
         </div>
         <h2 class="niveau"><?= $niveau ?></h2>
         <h3 class="title"><?= $titre; ?></h3>
         <p class="description"><?=  $description ?></p>
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="cours_id" value="<?= $id_cours; ?>">
            <a href="update_course.php?get_id=<?= $id_cours; ?>" class="option-btn">update</a>
            <input type="submit" value="delete" class="delete-btn" onclick="return confirm('delete this Course?');" name="delete">
         </form>
         <a href="view_course.php?get_id=<?= $id_cours; ?>" class="btn">view Course</a>
      </div>

    
    <?php 
    }
} else {
    echo '<p class="empty">no course added yet!</p>';
}
?>
        
      
    </section>

    <footer class="footer">
      © copyright @ 2023 by <span>Nisrine Aomari Abdelilah Elgharbaoui</span> 
    </footer>
    <script src="../js/admin_script.js"></script>

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
