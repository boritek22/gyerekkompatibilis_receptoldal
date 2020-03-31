<?php

session_start();

include("auth.php");
include("database.php");
$sz_recipes = lekerdezes($db, "select * from sz_recipes");
$sz_recipes_rand = lekerdezes($db,"select * from sz_recipes order by rand() limit 10");


//ETTŐL LÁTSZIK AZ AMI BEJELENTKEZÉS UTÁN VAN
if (azonositott_e()) {

}
?>

<!DOCTYPE html>
<html lang="hu">

<head>
  <meta charset="utf-8">
  <title>Főoldal</title>
  <link rel="icon" href="media/logo9.png">
  <link href="css/main.css" rel="stylesheet" type="text/css" title="alap">
  <script src="js/menu.js"></script>
</head>

<body>
  <nav>
    <div style="height:50px;">
      <div class="menu" id="mainmenu">
        <!-- <a href="index.php"><img style="max-width: 40%" alt="logo6" src="media/bori_logo_borderless.png"></a> -->
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
        <table class="search_and_log">
          <th>
            <div class="search-container">
              <form action="/search.php">
                <input type="text" placeholder="Search.." name="search">
          </th>
          <th>
            <button class="searchbtn" type="submit"><i>Keres</i></button>
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
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      </table>
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
  </nav>


  <div class="slideshow-container">

    <div class="mySlides fade">
      <a href="https://www.google.com"><img src="media/img_nature_wide.jpg" style="width:100%">
    </div>

    <div class="mySlides fade">
      <a href="https://www.youtube.com/watch?v=V-zXT5bIBM0"><img src="media/dorialszik2.png" style="width:100%">
    </div>

    <div class="mySlides fade">
      <a href="https://www.google.com"><img src="media/img_mountains_wide.jpg" style="width:100%">
    </div>

  </div>
  <div style="text-align:center">
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
  </div>
  <a href="semmi"></a>
  <main class="tartalom">
    <!-- <div id="munkalap_folott"> -->
    </div>
    <article id="munkalap1">
      <article id="munkalap2">

        <div>
          <?php
          foreach ($sz_recipes as $sz_recipes) { ?>
              <ul>
                <a href="recipes.php?id=<?= $sz_recipes['id'] ?>"><?= $sz_recipes['name'] ?></a>
                <!-- <div id="ar"><?php /*echo($MenuItem['Price'].' Ft') */ ?></div> -->
                <?php if (azonositott_e()) { ?>
                  <!-- <a id="ar" href="basket.php"><img style="width: 50px; height: 50px"; class="gomb" type="button" src="https://cdn4.iconfinder.com/data/icons/shopping-21/64/shopping-06-512.png" alt="Shopping cart"></a> -->
                <?php } ?>
              </ul>
          <?php } ?>
        </div>
      </article>
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