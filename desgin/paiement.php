<!DOCTYPE html>
<?php

include 'Connecting/connect.php';

if(isset($_COOKIE['user_id1'])){
   $user_id = $_COOKIE['user_id1'];
}else{
   $user_id = '';
header("Location:loginT.php");
}

 $stql1="SELECT id_eleve,nom_eleve,prenom_eleve,photo_eleve FROM eleve where id_eleve = $user_id";
    


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
   <title>contact us</title>

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



<section class="contact">

   <div class="row">

      <div class="image">
         <img src="images/contact-img.svg" alt="">
      </div>

      <form action="" method="post">
         <h3>Billing address</h3>

         <p style=" font-size: 1.5rem; color: var(--black);">Name on the card</p>
         <input type="text" placeholder="Name of the card" name="name" required maxlength="50" class="box">
         <p style=" font-size: 1.5rem; color: var(--black);">Card number</p>
         <input type="text" placeholder="0000 0000 0000 00000" name="name" required maxlength="50" class="box">
         <p style=" font-size: 1.5rem; color: var(--black);">HVAC/CCV</p>
         <input type="email" placeholder="CVC" name="email" required maxlength="50" class="box">
         <p style=" font-size: 1.5rem; color: var(--black);">MM/AA</p>
         <input type="number" placeholder="MM/AA" name="number" required maxlength="50" class="box">
   
         <a href="MyCourses1.php"  class="inline-btn">Proceed to payment</a>
      </form>

   </div>

   <div class="box-container">

      <div class="box">
         <i class="fas fa-phone"></i>
         <h3>phone number</h3>
         <a href="tel:1234567890">123-456-7890</a>
         <a href="tel:1112223333">111-222-3333</a>
      </div>
      
      <div class="box">
         <i class="fas fa-envelope"></i>
         <h3>email address</h3>
         <a href="mailto:A.elgharbaoui@mundiapolis.ma">A.elgharbaoui@mundiapolis.ma</a>
         <a href="mailto:naomari@mundiapolis.ma">n.aomari@mundiapolis.ma</a>
      </div>

      <div class="box">
         <i class="fas fa-map-marker-alt"></i>
         <h3>office address</h3>
         <a href="#">flat no. 1, a-1 building, jogeshwari, Casablanca, morroco - 400104</a>
      </div>

   </div>

</section>














<footer class="footer">

   &copy; copyright @ 2022 by <span>IQ Learn</span> | all rights reserved!

</footer>

<!-- custom js file link  -->
<script src="js/script.js"></script>

   
</body>
</html>