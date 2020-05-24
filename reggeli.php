<?php

session_start();

include("auth.php");
include("database.php");
$sz_recipes = lekerdezes($db, "select * from sz_recipes");
$sz_recipes_rand1 = lekerdezes($db, "select * from sz_recipes where image <> '' and category = 'reggeli' order by rand() limit 1");
$sz_recipes_rand2 = lekerdezes($db, "select * from sz_recipes where image <> '' and category = 'reggeli' order by rand() limit 1");
$sz_recipes_rand3 = lekerdezes($db, "select * from sz_recipes where image <> '' and category = 'reggeli' order by rand() limit 1");
$sz_recipes_rand4 = lekerdezes($db, "select * from sz_recipes where image <> '' and category = 'reggeli' order by rand() limit 1");
$sz_recipes_rand5 = lekerdezes($db, "select * from sz_recipes where image <> '' and category = 'reggeli' order by rand() limit 1");

//ETTŐL LÁTSZIK AZ AMI BEJELENTKEZÉS UTÁN VAN
if (azonositott_e()) {
}
?>

<!DOCTYPE html>
<html lang="hu">

<head>
  <meta charset="utf-8">
  <title>Reggeli</title>
  <link rel="icon" href="media/logo9.png">
  <link href="css/main.css" rel="stylesheet" type="text/css" title="alap">
  <script src="js/menu.js"></script>

  <div class="slideshow-container">

    <div class="mySlides fade">
      <?php foreach ($sz_recipes_rand1 as $sz_recipes_rand1); ?>
      <a href="recipes.php?id=<?= $sz_recipes_rand1['id'] ?>"><img style="height: 350px; width: 100%;" src="media/<?php echo ($sz_recipes_rand1['image']) ?>"></a>
      <div class="slidetext"><a style="color: rgb(173, 255, 91);" href="recipes.php?id=<?= $sz_recipes_rand1['id'] ?>"><?php echo ($sz_recipes_rand1['name']) ?></a></div>
    </div>

    <div class="mySlides fade">
      <?php foreach ($sz_recipes_rand2 as $sz_recipes_rand2); ?>
      <a href="recipes.php?id=<?= $sz_recipes_rand2['id'] ?>"><img style="height: 350px; width: 100%;" src="media/<?php echo ($sz_recipes_rand2['image']) ?>"></a>
      <div class="slidetext"><a style="color: rgb(173, 255, 91);" href="recipes.php?id=<?= $sz_recipes_rand2['id'] ?>"><?php echo ($sz_recipes_rand2['name']) ?></a></div>
    </div>

    <div class="mySlides fade">
      <?php foreach ($sz_recipes_rand3 as $sz_recipes_rand3); ?>
      <a href="recipes.php?id=<?= $sz_recipes_rand3['id'] ?>"><img style="height: 350px; width: 100%;" src="media/<?php echo ($sz_recipes_rand3['image']) ?>"></a>
      <div class="slidetext"><a style="color: rgb(173, 255, 91);" href="recipes.php?id=<?= $sz_recipes_rand3['id'] ?>"><?php echo ($sz_recipes_rand3['name']) ?></a></div>
    </div>

    <div class="mySlides fade">
      <?php foreach ($sz_recipes_rand4 as $sz_recipes_rand4); ?>
      <a href="recipes.php?id=<?= $sz_recipes_rand4['id'] ?>"><img style="height: 350px; width: 100%;" src="media/<?php echo ($sz_recipes_rand4['image']) ?>"></a>
      <div class="slidetext"><a style="color: rgb(173, 255, 91);" href="recipes.php?id=<?= $sz_recipes_rand4['id'] ?>"><?php echo ($sz_recipes_rand4['name']) ?></a></div>
    </div>

    <div class="mySlides fade">
      <?php foreach ($sz_recipes_rand5 as $sz_recipes_rand5); ?>
      <a href="recipes.php?id=<?= $sz_recipes_rand5['id'] ?>"><img style="height: 350px; width: 100%;" src="media/<?php echo ($sz_recipes_rand5['image']) ?>"></a>
      <div class="slidetext"><a style="color: rgb(173, 255, 91);" href="recipes.php?id=<?= $sz_recipes_rand5['id'] ?>"><?php echo ($sz_recipes_rand5['name']) ?></a></div>
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

<body>
  <nav class="menu" id="mainmenu">
    <div class="maci" style="position: relative; left: 0; top: 0;">
      <a href="index.php"><img src="media/maciszebb.png" width="50" height="60" ; style="position: absolute; top: 0px; left: 10px;" /></a>
    </div>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
    <table class="search_and_log">
      <th></th>
      <th>
        <div class="search-container">
          <form action="/search.php">
            <input type="text" placeholder="Search.." name="search">
      </th>
      <th>
        <button class="searchbtn" type="submit">Keres</button>
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
            <button class="loginbtn" type="submit">Kijelentkezés</button>
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
          <a href="halloween.php">Halloween</a>
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
        <h1 style="text-align:center">Reggeli</h1>

        <div style="margin-left: 2%; display: flex; flex-wrap: wrap;">
          <?php
          foreach ($sz_recipes as $sz_recipe) {
            if ($sz_recipe['category'] == 'reggeli') {
              if ($sz_recipe['image'] != NULL) { ?>
                <div style="display: flex">
                  <a href="recipes.php?id=<?= $sz_recipe['id'] ?>"><img class="receptkep" style="max-width: 200px" src="media/<?php echo ($sz_recipe['image']) ?>">
                    <div class="felirat"><?php echo ($sz_recipe['name']) ?></div>
                  </a>
                </div>
              <?php } else { ?>
                <a href="recipes.php?id=<?= $sz_recipe['id'] ?>"><img class="receptkep" style="max-width: 200px" src="media/default.jpg">
                  <div class="felirat"><?php echo ($sz_recipe['name']) ?></div>
                </a>
                <?php } ?>&nbsp;
              <?php } ?>
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