<?php

include '../Connecting/connect.php';



if(isset($_POST['submit'])){

  $id_for=$_POST['id'];
 $status = $_POST['status'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $niveau=$_POST['niveau'];
    $matiere=$_POST['sub'];


   $thumb = $_FILES['image']['name'];
   
  
   $thumb_size = $_FILES['image']['size'];
   $thumb_tmp_name = $_FILES['image']['tmp_name'];
   $thumb_folder = '../fichier/'.$thumb;


   if($thumb_size > 2000000){
      $message[] = 'image size is too large!';
   }else{
    
    $sql = "INSERT INTO courssoutien (`titre_cours`, `niveau`,`id_matiere_Matiere`, `id_formateur_Formateur`, `photo`, `status`, `description`) VALUES ('$title', '$niveau',$matiere,$id_for ,'$thumb', '$status', '$description')";
    mysqli_query($mysqli, $sql);
      move_uploaded_file($thumb_tmp_name, $thumb_folder);
     
      $message[] = 'new course uploaded!';
   }

   header("Location:Courses.php");
exit;

   

}

?>