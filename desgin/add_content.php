<?php 

include 'Connecting/connect.php';


     if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
}






if(isset($_POST['submit'])){

  $idcours=$_POST['id_get'];
 $get_id=$_POST['id_user'];
    
    $sql = "INSERT INTO `inscription`(`id_cours_CoursSoutien`, `id_eleve_Eleve`) VALUES ('$idcours','$get_id')";
    mysqli_query($mysqli, $sql);
      move_uploaded_file($thumb_tmp_name, $thumb_folder);
     
     
   

   header("Location:Courses.php");
exit;

   

}




?>