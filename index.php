<?php

session_start();

include("auth.php");
include("database.php");
$sz_users = lekerdezes($db, "select * from sz_users");
$sz_recipes = lekerdezes($db, "select * from sz_recipes");
$sz_recipes_rand1 = lekerdezes($db, "select * from sz_recipes where image <> '' order by rand() limit 1");
$sz_recipes_rand2 = lekerdezes($db, "select * from sz_recipes where image <> '' order by rand() limit 1");
$sz_recipes_rand3 = lekerdezes($db, "select * from sz_recipes where image <> '' order by rand() limit 1");
$sz_recipes_rand4 = lekerdezes($db, "select * from sz_recipes where image <> '' order by rand() limit 1");
$sz_recipes_rand5 = lekerdezes($db, "select * from sz_recipes where image <> '' order by rand() limit 1");


//ETTŐL LÁTSZIK AZ AMI BEJELENTKEZÉS UTÁN VAN
if (azonositott_e()) {
}
?>

<!DOCTYPE html>
<html lang="hu">

<head>
  <meta charset="utf-8">
  <title>Játssz az Étellel!</title>
  <link rel="icon" href="media/logo9.png">
  <link href="css/main.css" rel="stylesheet" type="text/css" title="alap">
  <script src="js/menu.js"></script>
  <link href="style.css" rel="stylesheet" type="text/css" title="alap">


  <div class="slideshow-container">

    <div class="mySlides fade">
      <?php foreach ($sz_recipes_rand1 as $sz_recipes_rand1); ?>
      <a href="recipes.php?id=<?= $sz_recipes_rand1['id'] ?>"><img src="media/<?php echo ($sz_recipes_rand1['image']) ?>"></a>
    </div>

    <div class="mySlides fade">
      <?php foreach ($sz_recipes_rand2 as $sz_recipes_rand2); ?>
      <a href="recipes.php?id=<?= $sz_recipes_rand2['id'] ?>"><img src="media/<?php echo ($sz_recipes_rand2['image']) ?>"></a>

    </div>

    <div class="mySlides fade">
      <?php foreach ($sz_recipes_rand3 as $sz_recipes_rand3); ?>
      <a href="recipes.php?id=<?= $sz_recipes_rand3['id'] ?>"><img src="media/<?php echo ($sz_recipes_rand3['image']) ?>"></a>
    </div>

    <div class="mySlides fade">
      <?php foreach ($sz_recipes_rand4 as $sz_recipes_rand4); ?>
      <a href="recipes.php?id=<?= $sz_recipes_rand4['id'] ?>"><img src="media/<?php echo ($sz_recipes_rand4['image']) ?>"></a>
    </div>

    <div class="mySlides fade">
      <?php foreach ($sz_recipes_rand5 as $sz_recipes_rand5); ?>
      <a href="recipes.php?id=<?= $sz_recipes_rand5['id'] ?>"><img src="media/<?php echo ($sz_recipes_rand5['image']) ?>"></a>
    </div>

  </div>
  <div style="text-align:center">
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
  </div>

</head>

<!-- <body id="example1">
<video autoplay muted loop id="myVideo">
  <source src="kite.mp4" type="video/mp4">
</video> -->


<nav class="menu" id="mainmenu">
  <div class="maci" style="position: relative; left: 0; top: 0;">
    <a href="index.php"><img src="media/maciszebb.png" width="50" height="60" ; style="position: absolute; top: 0px; left: 10px;" /></a>
  </div>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
  <table class="search_and_log">
    <th>
      <div class="search-container">
        <form action="./search.php" method="POST">
          <input type="text" placeholder="Keresés..." name="search">
    </th>
    <th>
      <button class="searchbtn" type="submit" name="submit-search"><i>Keres</i></button>
    </th>
    <th>&nbsp;</th>
    </form>
    </div>
    <th>
      <?php if (!azonositott_e()) { ?>
        <form method="get" action="./login.php">
          <button class="loginbtn" type="submit">Login/Register</button>
        </form>
      <?php } ?>

      <?php if (azonositott_e()) { ?>
        <form method="get" action="./logout.php">
          <button class="loginbtn" type="submit">Logout</button>
        </form>
      <?php } ?>
    </th>
  </table>
  <div class="valami">
    <a></a>
    <!-- <li><a href="index.php"><img style="max-width: 20%" class="ikon" alt="logo6" src="media/logo6.png"></a></li> -->
    <a href="reggeli.php">Reggeli</a>
    <a href="ebed.php">Ebéd</a>
    <a href="edessegek.php">Édességek</a>
    <a href="sossagok.php">Sós finomságok</a>
    <div class="dropdown">
      <button class="dropbtn">Ünnepi lakoma</button>
      <div class="content">
        <a href="karacsony.php">Karácsony</a>
        <a href="szulinap.php">Szülinap</a>
        <a href="husvet.php">Húsvét</a>
        <a href="szilveszter.php">Szilveszter</a>
        <a href="halloween.phpp">Halloween</a>
      </div>
    </div>
    <a href="italok.php">Italok</a>
    <a href="kreativ.php">Kreatív</a>
  </div>
</nav>




<a href="semmi"></a>
<main class="tartalom">
  <!-- <div id="munkalap_folott"> -->
  </div>
  <article id="munkalap1">
    <article id="munkalap3">

      <?php if (azonositott_e()) { ?>
        <h1 class="szoveg">Szia,
          <?php echo (isset($_SESSION['felhasznalo'])) ? $_SESSION['felhasznalo']['username'] . '! ' : 'Ismeretlen! '; ?>Jó főzőcskézést, érezd jól magad!</h1>
      <?php } ?>

      <!--innen kell a grid -->
      <div style="display: flex; flex-wrap: wrap;">
        <?php
        foreach ($sz_recipes as $sz_recipe) { ?>
          <div style="display: flex">
            <a href="recipes.php?id=<?= $sz_recipe['id'] ?>"><img style="max-width: 200px" src="media/<?php echo ($sz_recipe['image']) ?>"></a>
            <!-- <div id="ar"><?php /*echo($MenuItem['Price'].' Ft') */ ?></div> -->
            <?php if (azonositott_e()) { ?>
              <!-- <a id="ar" href="basket.php"><img style="width: 50px; height: 50px"; class="gomb" type="button" src="https://cdn4.iconfinder.com/data/icons/shopping-21/64/shopping-06-512.png" alt="Shopping cart"></a> -->
            <?php } ?>
          </div>
        <?php } ?>
      </div>
    </article>
    <!-- <img id="labjegyzet" src="media/macikkk.png" alt=""> -->
  </article>

</main>
<script>
  var slideIndex = 0;
  showSlides();

  function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {
      slideIndex = 1
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
    setTimeout(showSlides, 2000); // Change image every 2 seconds
  }
</script>

<!-- <script>
    // Get the modal
    var modal = document.getElementById('page');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script> -->

</body>

</html>