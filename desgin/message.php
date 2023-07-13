<!DOCTYPE html>

<?php 
include 'Connecting/connect.php';

if(isset($_COOKIE['user_id1'])){
   $user_id = $_COOKIE['user_id1'];
}else{
   $user_id = '';
header("Location:login.php");
}



if(isset($_GET['path']))
{
//Read the filename
$filename = $_GET['path'];
//Check the file exists or not
if(file_exists($filename)) {

//Define header information
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: 0");
header('Content-Disposition: attachment; filename="'.basename($filename).'"');
header('Content-Length: ' . filesize($filename));
header('Pragma: public');

//Clear system output buffer
flush();

//Read the size of the file
readfile($filename);

//Terminate from the script
die();

$get_id= $_GET['user_id'];

header("Location:message.php?get_id=.'$get_id'");
}

}

 if(isset($_GET['eleve_id'])){
   $get_id = $_GET['eleve_id'];


}else{
   $get_id = '';
   
}







   if(isset($_POST['add_message'])){

   if($user_id != ''){

     
      $message_box = $_POST['message_box'];
   
      $eleve_id = $_POST['eleve_id'];
 

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
     
      $message[] = 'new course uploaded!';
   }}}




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

<!-- side bar section ends --> 
   <section class="comments">

 

   <h1 class="heading">Messages</h1>

   
   <div class="show-comments">
      <?php

      $stqlM="SELECT * FROM message WHERE id_eleve_Eleve = $user_id And id_formateur_Formateur=$get_id";
    
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

      
          $stqlE="SELECT * FROM eleve Where id_eleve = $id_eleve_Eleve";
          $resultE=mysqli_query($mysqli,$stqlE);
          while($res = mysqli_fetch_array($resultE)){
            
               $nomE=$res['nom_eleve'];
               $prenomE=$res['prenom_eleve'];
               $photoE=$res['photo_eleve'];
               $matiereE=$res['email_eleve'];
         }


   

      ?>
      <div class="box" style="<?php if($id_formateur_Formateur == $get_id){echo 'order:-1;';} ?>">
         <?php
            if($type_impE == "envoi"){
               echo '   <div class="user">
            <img src="fichier/'.$photoE.'" alt="">
            <div>
               <h3>'.$nomE .' '. $prenomF.'</h3>
               <span>'. $date_envoi.'</span>
            </div>
         </div>
         <p class="text"> '.$contenu.'</p>
         <hr class="divider">
         ';

               if($fichier_joint != NULL){
        echo ' <button class="btn"><a href="message.php?path=fichier/'.$fichier_joint.'">Download file</a></button> ';
               }
               else {
               echo '<hr class="divider">';
            }
            }
            else
               {
 echo '  <div class="user">
            <img src="fichier/'.$photoF.'" alt="">
            <div>
               <h3>'.$nomF .' '. $prenomF.'</h3>
               <span>'. $date_envoi.'</span>
            </div>
         </div>
         <p class="text"> '.$contenu.'</p>
         <hr class="divider">
         ';
        if($fichier_joint != NULL){
        echo ' <button class="btn"><a href="message.php?path=../fichier/'.$fichier_joint.'">Download file</a></button> ';
               }
            else {
               echo '<hr class="divider">';
            }
         }
         
         ?>
     


         
         
        
      </div>
      <?php
       }
      }else{
         echo '<p class="empty">no messages added yet!</p>';
      }
      ?>
      </div>
<!-- downlowd -->

      

      <!-- Send -->

  

<section class="comments">

   
 
   
 

       <h1 class="heading">add a message</h1>

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