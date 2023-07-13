

<!DOCTYPE html>
<?php

//refer to Connexion page 

 include_once("../Connecting/connect.php");

 if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
header("Location:loginT.php");
}


  //retreive data from DataBase

   $stql="SELECT id_formateur,nom_formateur,prenom_formateur,photoF,specialite FROM formateur WHERE id_formateur =$user_id";
    
    $result=mysqli_query($mysqli,$stql);


    while($res = mysqli_fetch_array($result)){
    $id=$res['id_formateur'];
    $nom=$res['nom_formateur'];
    $prenom=$res['prenom_formateur'];
    $photo=$res['photoF'];
    $matiere=$res['specialite'];
    }

    ?>
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
<body >

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
   
<section class="playlist-form">

   <h1 class="heading">create playlist</h1>

   <form action="add.php" method="post" enctype="multipart/form-data">
    <input name="id" type="hidden" value="<?php echo $id ?>">
      <p>course status <span>*</span></p>
      <select name="status" class="box" required="">
         <option value="" selected="" disabled="">-- select status</option>
         <option value="active">active</option>
         <option value="deactive">deactive</option>
      </select>
      <p>course title <span>*</span></p>
      <input type="text" name="title" maxlength="100" required="" placeholder="enter course title" class="box">

       <p>course niveau <span>*</span></p>
      <input type="text" name="niveau" maxlength="100" required="" placeholder="enter your ?" class="box">

      <p>subject <span>*</span></p>
      <select name="sub" class="box" required="">
         <option value="" selected="" disabled="">-- select subject</option>
         <option value="1">Maths</option>
         <option value="2">Physics</option>
        <option value="3">CS</option>
         <option value="4">English</option>
         <option value="5">Svt</option>
         <option value="6">French</option>
      </select>
      <p>course description <span>*</span></p>
      <textarea name="description" class="box" required="" placeholder="write description" maxlength="1000" cols="30" rows="10"></textarea>
      <p>Course Image <span>*</span></p>
      <input type="file" name="image" accept="image/*" required="" class="box">
      <input type="submit" value="create playlist" name="submit" class="btn">
   </form>

</section>















<footer class="footer">

   © copyright @ 2023 by <span>Nisrine Aomari Abdelilah ELgharbaoui</span>
</footer>
<script src="../js/admin_script.js"></script>


</body>
</html>