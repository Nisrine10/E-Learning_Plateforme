<!DOCTYPE html>
<?php

include '../Connecting/connect.php';
if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
header("Location:loginT.php");
}


   $stql="SELECT id_formateur,nom_formateur,prenom_formateur,photoF,specialite FROM formateur WHERE id_formateur = $user_id ";
    
    $result=mysqli_query($mysqli,$stql);


    while($res = mysqli_fetch_array($result)){
    $id_for=$res['id_formateur'];
    $nom=$res['nom_formateur'];
    $prenom=$res['prenom_formateur'];
    $photo1=$res['photoF'];
    $matiere=$res['specialite'];
    }

    if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   
}

     $stql2="SELECT * FROM courssoutien WHERE id_cours=$get_id";

    $result2=mysqli_query($mysqli,$stql2);

     while($res = mysqli_fetch_array($result2)){
     
   
    $titre=$res['titre_cours'];
    $niveau=$res['niveau'];
    $photo=$res['photo'];
    $status=$res['status'];
    $description=$res['description'];
    }

    



if(isset($_POST['submit'])){

   $title = $_POST['title'];
  
   $description = $_POST['description'];

   $status = $_POST['status'];
 //  $niveau = $_POST['niveau'];
   $image = $_POST['old_image'];
   $image = $_FILES['image']['name'];
   
  

   $update_playlist =mysqli_query($mysqli,"UPDATE `courssoutien` SET `titre_cours`='$title',`photo`='$image',`status`='$status',`description`='$description' WHERE id_cours=$get_id");
  

 

   //redirectig to the display page. In our case, it is index.php
        header("Location: Courses.php"); 

}

if(isset($_POST['delete'])){
  //deleting the row from table
$result = mysqli_query($mysqli, "DELETE FROM courssoutien WHERE id_cours=$get_id");
 
//redirecting to the display page (index.php in our case)
header("Location:Courses.php");
}

?>
<html lang="en"><head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Playlist</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

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
<section class="playlist-form">

   <h1 class="heading">update cours</h1>

      <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="old_image" value="<?php $photo ?>">
      <p>Course status <span>*</span></p>
      <select name="status" class="box" required="">
         <option value="active" selected="">active</option>
         <option value="active">active</option>
         <option value="deactive">deactive</option>
      </select>
      <p>Course Image <span>*</span></p>
      <input type="text" name="title" maxlength="100" required="" placeholder="enter playlist title" value="<?php echo $titre ?>" class="box">
      <p>playlist description <span>*</span></p>
      <textarea name="description" class="box" required="" placeholder="write description" maxlength="1000" cols="30" rows="10"><?php echo $description ?></textarea>
      <p>Course Image <span>*</span></p>
      <div class="thumb">
         <span>0</span>
         <img src="../fichier/<?php echo $photo ?>" alt="<?php echo $photo ?>">
      </div>
      <input type="file" name="image" accept="image/*" class="box">
      <input type="submit" value="update playlist" name="submit" class="btn">
      <div class="flex-btn">
         <input type="submit" value="delete" class="delete-btn" onclick="return confirm('delete this playlist?');" name="delete">
         <a href="view_playlist.php?get_id=l2Gmi5S0Uyiqtwl5OumG" class="option-btn">view playlist</a>
      </div>
   </form>
   
</section>















<footer class="footer">

   © copyright @ 2023 by <span>mr. web designer</span> | all rights reserved!

</footer>
<script src="../js/admin_script.js"></script>
</body>

</html>