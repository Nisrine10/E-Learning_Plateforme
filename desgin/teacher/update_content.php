<?php

include '../Connecting/connect.php';


 if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   
}
if(isset($_POST['submit'])){

   
   $status = $_POST['status'];
 
   $title = $_POST['title'];
   
   $type_doc = $_POST['type'];

   $coursId = $_POST['course'];
  
   $date=date("Y-m-d");

   $thumb = $_FILES['thumb']['name'];

   $thumb_size = $_FILES['thumb']['size'];
   $thumb_tmp_name = $_FILES['thumb']['tmp_name'];
   $thumb_folder = '../fichier/'.$thumb;

   $video = $_FILES['video']['name'];
  
   
   $video_tmp_name = $_FILES['video']['tmp_name'];
   $video_folder = '../fichier/'.$video;

    move_uploaded_file($thumb_tmp_name, $thumb_folder);
       move_uploaded_file($video_tmp_name, $video_folder);

   if($thumb_size ==0){
      
   }else{

      

   $sql = "UPDATE `document` SET `libelle_doc`='$title',`type_doc`='$type_doc',`dateDepot`='$date',`pieceJoint`='$video',`photo`='$thumb',`status`='$status' WHERE id_doc=$get_id";
   
   mysqli_query($mysqli, $sql);
      move_uploaded_file($thumb_tmp_name, $thumb_folder);


      
    $sqlM= "SELECT MAX(id_doc) FROM document WHERE id_doc=$get_id ";

    $resultM=mysqli_query($mysqli,$sqlM);


    while($res = mysqli_fetch_array($resultM)){
    $id_doc=$res['MAX(id_doc)'];
    }

      $sql2 = "UPDATE `contenu` SET `id_cours_CoursSoutien`='$coursId',`id_doc_Document`='$id_doc' WHERE id_doc_Document=$get_id";
    mysqli_query($mysqli, $sql2);


    header("Location:Courses.php");


   }
}



    $sql1= "SELECT libelle_doc,type_doc,pieceJoint,photo,status FROM document WHERE id_doc=$get_id ";

    $result1=mysqli_query($mysqli,$sql1);


    while($res = mysqli_fetch_array($result1)){
 
    $libelle_doc=$res['libelle_doc'];
     $type_doc=$res['type_doc'];
     $vid=$res['pieceJoint'];
      $img=$res['photo'];
      $statusV=$res['status'];

     

    }

      $sqlC= "SELECT titre_cours FROM courssoutien WHERE id_cours IN (
      SELECT id_cours_CoursSoutien FROM contenu WHERE id_doc_Document = $get_id
    ) ";

    $resultC=mysqli_query($mysqli,$sqlC);


    while($res = mysqli_fetch_array($resultC)){
    $title=$res['titre_cours'];
  

    }
     
   

   




   $stql="SELECT id_formateur,nom_formateur,prenom_formateur,photoF,specialite FROM formateur";
    
    $resultl=mysqli_query($mysqli,$stql);


    while($res = mysqli_fetch_array($resultl)){
    $id=$res['id_formateur'];
    $nom=$res['nom_formateur'];
    $prenom=$res['prenom_formateur'];
    $photo=$res['photoF'];
    $matiere=$res['specialite'];
    }

    

?>

<!DOCTYPE html>

<html lang="en"><head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Playlist</title>

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


<section class="video-form">
<?php  echo '<p>'.$img.'</p>'; ?>
   <h1 class="heading">upload content</h1>

   <form action="" method="post" enctype="multipart/form-data">
         
      <p>video status <span>*</span></p>
      <select name="status" class="box" required>
         <option value="" selected disabled><?= $statusV ?></option>
         <option value="active">active</option>
         <option value="deactive">deactive</option>
      </select>
      <p>video title <span>*</span></p>
      <input type="text" name="title" maxlength="100" required placeholder="enter video title"  class="box" value="<?= $libelle_doc?>">
      <p>file type <span>*</span></p>
      <select name="type" class="box" required>
         <option value="<?= $type_doc ?>" disabled selected><?= $type_doc ?></option>
         <option value="file"  >file</option>
         <option value="video" >video</option>
         <option value="live"  >live</option>
         </select>
     
      <p>video cours <span>*</span></p>
      <select name="course" class="box" required>
         <option value="<?= $title ?>" disabled selected><?= $title ?></option>
       

           <?php 

             $sqlR= "SELECT id_cours,titre_cours FROM courssoutien ";

    $resultR=mysqli_query($mysqli,$sqlR);
        
        if ($resultR->num_rows > 0) {
    // output data of each row
    while($row = $resultR->fetch_assoc()) {
     $id_doc1=$row['id_cours'];
    $libelle_doc1=$row['titre_cours'];
   
        

        ?>
         <option value="<?= $id_doc1 ?>"><?= $libelle_doc1 ?></option>
        <?php
       }
           }else{
            echo '<option value="" disabled>no cours created yet!</option>';
         }
        ?>
       
      </select>
      
      <img src="../fichier/<?= $img ?>" alt="<?php echo $img ?>">
      <p>update Image <span>*</span></p>
      <input type="file" name="thumb" accept="image/*" required class="box">
      <video src="../fichier/<?= $vid ?>" controls></video>
      <p>update video <span>*</span></p>
      <input type="file" name="video" accept="video/*" required class="box">
      
      <input type="submit" value="upload video" name="submit" class="btn">
   </form>

</section>
















<script src="../js/admin_script.js"></script>

</body>
</html>