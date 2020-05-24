<?php
session_start();

include("auth.php");
include("database.php");

$sz_recipes = lekerdezes($db, "select * from sz_recipes");
// $hozzavalok = lekerdezes($db, "SELECT sz_ingredients.name FROM sz_recipes_ingredients JOIN sz_ingredients ON sz_recipes_ingredients.ingredientId=sz_ingredients.id");
// $id = $_GET['recipeId'];
?>
<!DOCTYPE html>
<html lang="hu">

<head>
  <meta charset="utf-8">
  <title>Játssz az Étellel!</title>
  <link rel="icon" href="media/logo9.png">
  <link href="css/main.css" rel="stylesheet" type="text/css" title="alap">
  <script src="js/menu.js"></script>
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



        <?php if (azonositott_e()) {

          $userAdmin = $_SESSION["felhasznalo"]['admin'];
          // $show = $_POST['show'];

        }
        // vegrehajtas($db, "UPDATE `sz_recipes` SET `show`= $show");
        ?>
        <div style="margin-left: 2%; display: flex; flex-wrap: wrap;">
          <?php if (azonositott_e()) { ?>
            <?php if ($userAdmin == 1) {
              foreach ($sz_recipes as $sz_recipe) {
                if($sz_recipe['image'] != NULL){ ?>
                <div style="display: flex">
                  <a href="recipes.php?id=<?= $sz_recipe['id'] ?>"><img class="receptkep" style="max-width: 200px" src="media/<?php echo ($sz_recipe['image']) ?>"><div class="felirat"><?php echo ($sz_recipe['name']) ?></div></a>
                </div>
                <?php }
                }
            } else {
              echo "Ezt az oldalt csak adminok láthatják.";
            }
          } else {
            echo "Ezt az oldalt csak adminok láthatják.";
          } ?>
        </div>