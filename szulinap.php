<?php

session_start();

include("auth.php");
include("database.php");
$sz_recipes = lekerdezes($db, "select * from sz_recipes");
$sz_recipes1 = lekerdezes($db, "select * from sz_recipes where sz_recipes.show = '1'");
$sz_recipes0 = lekerdezes($db, "select * from sz_recipes where sz_recipes.show = '0'");

$sz_recipes_rands = lekerdezes($db, "select * from sz_recipes where category = 'szulinapi' and sz_recipes.show = 1 order by rand() limit 5");

if (azonositott_e()) {
  $userAdmin = $_SESSION["felhasznalo"]['admin'];
}
?>

<!DOCTYPE html>
<html lang="hu">

<head>
  <meta charset="utf-8">
  <title>Szülinap</title>
  <link rel="icon" href="media/logo9.png">
  <link href="css/main.css" rel="stylesheet" type="text/css" title="alap">
  <script src="js/menu.js"></script>

  <div class="slideshow-container">

    <?php foreach ($sz_recipes_rands as $sz_recipes_rand) { ?>
      <div class="mySlides fade">
        <?php if ($sz_recipes_rand['image'] != NULL) { ?>
          <a href="recipes.php?id=<?= $sz_recipes_rand['id'] ?>"><img onerror="this.onerror=null; this.src='media/defaultslide.jpg'" alt="" style="height: 350px; width: 100%;" src="media/<?php echo ($sz_recipes_rand['image']) ?>"></a>
          <div class="slidetext"><a style="color: rgb(173, 255, 91);" href="recipes.php?id=<?= $sz_recipes_rand['id'] ?>"><?php echo ($sz_recipes_rand['name']) ?></a></div>
      </div>
    <?php } else { ?>
      <a href="recipes.php?id=<?= $sz_recipes_rand['id'] ?>"><img style="height: 350px; width: 100%;" src="media/defaultslide.jpg"></a>
      <div class="slidetext"><a style="color: rgb(173, 255, 91);" href="recipes.php?id=<?= $sz_recipes_rand['id'] ?>"><?php echo ($sz_recipes_rand['name']) ?></a></div>
  </div>
<?php } ?>
<?php } ?>


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
      <th>
        <div class="search-container">
          <form action="./search.php" method="POST">
            <input type="text" placeholder="Keresés..." name="search">
      </th>
      <th>
        <button class="searchbtn" type="submit" name="submit-search">Keres</button>
      </th>
      <th>&nbsp;</th>
      </form>
      </div>
      <th>
        <?php if (!azonositott_e()) { ?>
          <form method="get" action="./login.php">
            <button class="loginbtn" type="submit">Bejelentkezés</button>
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
    <article id="munkalap1szulinap">
      <article id="munkalap3szulinap">
        <h1 style="text-align:center">Szülinap</h1>

        <!--innen kell a grid -->
        <?php if (azonositott_e()) {

          if ($userAdmin == 1) { ?>

            <h3 style="margin-left: 2%">Már engedélyezett receptek</h3>
            <div style="margin-left: 2%; display: flex; flex-wrap: wrap;">
              <?php foreach ($sz_recipes1 as $sz_recipe1) {
                if ($sz_recipe1['category'] == 'szulinapi') {
                  if ($sz_recipe1['image'] != NULL) { ?>
                    <div style="display: flex">
                      <a href="recipes.php?id=<?= $sz_recipe1['id'] ?>"><img onerror="this.onerror=null; this.src='media/default.jpg'" alt="" class="receptkep" style="max-width: 200px" src="media/<?php echo ($sz_recipe1['image']) ?>">
                        <div class="felirat"><?php echo ($sz_recipe1['name']) ?></div>
                      </a>
                    </div>
                  <?php } else { ?>
                    <div style="display: flex">
                      <a href="recipes.php?id=<?= $sz_recipe1['id'] ?>"><img class="receptkep" style="max-width: 200px" src="media/default.jpg">
                        <div class="felirat"><?php echo ($sz_recipe1['name']) ?></div>
                      </a>
                    </div>
                    <?php } ?>&nbsp;
                  <?php } ?>
                <?php } ?>
            </div>
            <br>
            <hr style="width: 80%; color: black; border: 1px solid black;">
            <h3 style="margin-left: 2%">Még nem engedélyezett receptek</h3>
            <div style="margin-left: 2%; display: flex; flex-wrap: wrap;">
              <?php foreach ($sz_recipes0 as $sz_recipe0) {
                if ($sz_recipe0['category'] == 'szulinapi') {
                  if ($sz_recipe0['image'] != NULL) { ?>
                    <div style="display: flex">
                      <a href="recipes.php?id=<?= $sz_recipe0['id'] ?>"><img onerror="this.onerror=null; this.src='media/default.jpg'" alt="" class="receptkep" style="max-width: 200px" src="media/<?php echo ($sz_recipe0['image']) ?>">
                        <div class="felirat"><?php echo ($sz_recipe0['name']) ?></div>
                      </a>
                    </div>
                  <?php } else { ?>
                    <div style="display: flex">
                      <a href="recipes.php?id=<?= $sz_recipe0['id'] ?>"><img class="receptkep" style="max-width: 200px" src="media/default.jpg">
                        <div class="felirat"><?php echo ($sz_recipe0['name']) ?></div>
                      </a>
                    </div>
                    <?php } ?>&nbsp;
                  <?php } ?>
            </div>
          <?php } ?>

        <?php } else if ($userAdmin == 0) { ?>

          <div style="margin-left: 2%; display: flex; flex-wrap: wrap;">
            <?php foreach ($sz_recipes1 as $sz_recipe1) {
              if ($sz_recipe1['category'] == 'szulinapi') {
                if ($sz_recipe1['image'] != NULL) { ?>
                  <div style="display: flex">
                    <a href="recipes.php?id=<?= $sz_recipe1['id'] ?>"><img onerror="this.onerror=null; this.src='media/default.jpg'" alt="" class="receptkep" style="max-width: 200px" src="media/<?php echo ($sz_recipe1['image']) ?>">
                      <div class="felirat"><?php echo ($sz_recipe1['name']) ?></div>
                    </a>
                  </div>
                <?php } else { ?>
                  <a href="recipes.php?id=<?= $sz_recipe1['id'] ?>"><img class="receptkep" style="max-width: 200px" src="media/default.jpg">
                    <div class="felirat"><?php echo ($sz_recipe1['name']) ?></div>
                  </a>
                  <?php } ?>&nbsp;
                <?php } ?>
              <?php } ?>
            <?php } ?>
          </div>
        <?php } ?>

        <?php if (!azonositott_e()) { ?>

          <div style="margin-left: 2%; display: flex; flex-wrap: wrap;">
            <?php foreach ($sz_recipes1 as $sz_recipe1) {
              if ($sz_recipe1['category'] == 'szulinapi') {
                if ($sz_recipe1['image'] != NULL) { ?>
                  <div style="display: flex">
                    <a href="recipes.php?id=<?= $sz_recipe1['id'] ?>"><img onerror="this.onerror=null; this.src='media/default.jpg'" alt="" class="receptkep" style="max-width: 200px" src="media/<?php echo ($sz_recipe1['image']) ?>">
                      <div class="felirat"><?php echo ($sz_recipe1['name']) ?></div>
                    </a>
                  </div>
                <?php } else { ?>
                  <a href="recipes.php?id=<?= $sz_recipe1['id'] ?>"><img class="receptkep" style="max-width: 200px" src="media/default.jpg">
                    <div class="felirat"><?php echo ($sz_recipe1['name']) ?></div>
                  </a>
                  <?php } ?>&nbsp;
                <?php } ?>
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
      setTimeout(showSlides, 4000);
    }
  </script>

</body>

</html>