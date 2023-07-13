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




   if(isset($_POST['add_message'])){

   if($user_id != ''){

     
      $message_box = $_POST['message_box'];
   
      $eleve_id = $user_id;
 

    $thumb = $_FILES['file']['name'];
   
  
   $thumb_size = $_FILES['file']['size'];
   $thumb_tmp_name = $_FILES['file']['tmp_name'];
   $thumb_folder = 'fichier/'.$thumb;

   $date=date('Y-m-d');

   $impl='recoi';
   $implE='envoi';


   if($thumb_size > 2000000){
      $message[] = 'image size is too large!';
   }else{
    
    $msg = "INSERT INTO `message`(`date_envoi`, `date_reçoit`, `contenu`, `fichier_joint`, `type_implicationElv_envoyer`, `id_eleve_Eleve`, `type_implicationForm_envoi`, `id_formateur_Formateur`) VALUES 
    ('$date','$date','$message_box','$thumb','$implE','$user_id','$impl','$get_id')";
    mysqli_query($mysqli, $msg);
      move_uploaded_file($thumb_tmp_name, $thumb_folder);
     
      $message[] = 'new message sent!';
   }

   header("Location:Mymessages.php");

}

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

   
 
   
 

       <h1 class="heading">add a comment</h1>

   <form action="" method="post" class="add-comment" enctype="multipart/form-data">
      <input type="hidden" name="eleve_id" value="<?= $get_id; ?>">
      <textarea name="message_box" required placeholder="write your message..." maxlength="1000" cols="30" rows="10"></textarea>
      <input type="file"  name="file" class="inline-btn">
      <input type="submit" value="add comment" name="add_message" class="inline-btn">
   </form>

      </div>
   
</section>















<script src="js/admin_script.js"></script>

</body>
</html>