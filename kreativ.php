<?php

session_start();

include("auth.php");
include("database.php");
$sz_users = lekerdezes($db, "select * from sz_users");
$sz_kreativ = lekerdezes($db, "select * from sz_kreativ");


//ETTŐL LÁTSZIK AZ AMI BEJELENTKEZÉS UTÁN VAN
if (azonositott_e()) {
}
?>

<!DOCTYPE html>
<html lang="hu">

<head>
  <meta charset="utf-8">
  <title>Alkoss szépet!</title>
  <link rel="icon" href="media/logo9.png">
  <link href="css/main.css" rel="stylesheet" type="text/css" title="alap">
  <script src="js/menu.js"></script>
  <link href="style.css" rel="stylesheet" type="text/css" title="alap">

</head>

<body>

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
          <a href="halloween.php">Halloween</a>
        </div>
      </div>
      <a href="italok.php">Italok</a>
      <a href="kreativ.php" class="active">Kreatív</a>
    </div>
  </nav>


  <a href="semmi"></a>
  <main class="tartalom">
    <!-- <div id="munkalap_folott"> -->
    </div>
    <article id="munkalap1kreativ">
      <article id="munkalap3kreativ" style="border: 3px solid black;">




        <h2 style="margin-left: 2%">Mindennapok</h2>
        <div style="margin-left: 4%; display: flex; flex-wrap: wrap;">
          <?php
          foreach ($sz_kreativ as $sz_krea) {
            if ($sz_krea['ikon1'] != NULL) {
              if ($sz_krea['category'] == 'mindennapok') { ?>
                <div style="display: flex">
                  <a href="kezmuves.php?id=<?= $sz_krea['id'] ?>"><img class="receptkep" style="max-width: 200px" src="media/<?php echo ($sz_krea['ikon1']) ?>">
                    <div class="felirat"><?php echo ($sz_krea['name']) ?></div>
                  </a>
                </div>&nbsp;&nbsp;
              <?php } ?>
            <?php } ?>
          <?php } ?>
        </div>

        <h2 style="margin-left: 2%">Karácsony</h2>
        <div style="margin-left: 4%; display: flex; flex-wrap: wrap;">
          <?php
          foreach ($sz_kreativ as $sz_krea) {
            if ($sz_krea['ikon1'] != NULL) {
              if ($sz_krea['category'] == 'karacsony') { ?>
                <div style="display: flex">
                  <a href="kezmuves.php?id=<?= $sz_krea['id'] ?>"><img class="receptkep" style="max-width: 200px" src="media/<?php echo ($sz_krea['ikon1']) ?>">
                    <div class="felirat"><?php echo ($sz_krea['name']) ?></div>
                  </a>
                </div>&nbsp;&nbsp;
              <?php } ?>
            <?php } ?>
          <?php } ?>
        </div>

        <h2 style="margin-left: 2%">Szülinap</h2>
        <div style="margin-left: 4%; display: flex; flex-wrap: wrap;">
          <?php
          foreach ($sz_kreativ as $sz_krea) {
            if ($sz_krea['ikon1'] != NULL) {
              if ($sz_krea['category'] == 'szulinap') { ?>
                <div style="display: flex">
                  <a href="kezmuves.php?id=<?= $sz_krea['id'] ?>"><img class="receptkep" style="max-width: 200px" src="media/<?php echo ($sz_krea['ikon1']) ?>">
                    <div class="felirat"><?php echo ($sz_krea['name']) ?></div>
                  </a>
                </div>&nbsp;&nbsp;
              <?php } ?>
            <?php } ?>
          <?php } ?>
        </div>

        <h2 style="margin-left: 2%">Szilveszter</h2>
        <div style="margin-left: 4%; display: flex; flex-wrap: wrap;">
          <?php
          foreach ($sz_kreativ as $sz_krea) {
            if ($sz_krea['ikon1'] != NULL) {
              if ($sz_krea['category'] == 'szilveszter') { ?>
                <div style="display: flex">
                  <a href="kezmuves.php?id=<?= $sz_krea['id'] ?>"><img class="receptkep" style="max-width: 200px" src="media/<?php echo ($sz_krea['ikon1']) ?>">
                    <div class="felirat"><?php echo ($sz_krea['name']) ?></div>
                  </a>
                </div>&nbsp;&nbsp;
              <?php } ?>
            <?php } ?>
          <?php } ?>
        </div>

        <h2 style="margin-left: 2%">Húsvét</h2>
        <div style="margin-left: 4%; display: flex; flex-wrap: wrap;">
          <?php
          foreach ($sz_kreativ as $sz_krea) {
            if ($sz_krea['ikon1'] != NULL) {
              if ($sz_krea['category'] == 'husvet') { ?>
                <div style="display: flex">
                  <a href="kezmuves.php?id=<?= $sz_krea['id'] ?>"><img class="receptkep" style="max-width: 200px" src="media/<?php echo ($sz_krea['ikon1']) ?>">
                    <div class="felirat"><?php echo ($sz_krea['name']) ?></div>
                  </a>
                </div>&nbsp;&nbsp;
              <?php } ?>
            <?php } ?>
          <?php } ?>
        </div>

        <h2 style="margin-left: 2%">Halloween</h2>
        <div style="margin-left: 4%; display: flex; flex-wrap: wrap;">
          <?php
          foreach ($sz_kreativ as $sz_krea) {
            if ($sz_krea['ikon1'] != NULL) {
              if ($sz_krea['category'] == 'halloween') { ?>
                <div style="display: flex">
                  <a href="kezmuves.php?id=<?= $sz_krea['id'] ?>"><img class="receptkep" style="max-width: 200px" src="media/<?php echo ($sz_krea['ikon1']) ?>">
                    <div class="felirat"><?php echo ($sz_krea['name']) ?></div>
                  </a>
                </div>&nbsp;&nbsp;
              <?php } ?>
            <?php } ?>
          <?php } ?>
        </div>

        <h2 style="margin-left: 2%">Anyák napja</h2>
        <div style="margin-left: 4%; display: flex; flex-wrap: wrap;">
          <?php
          foreach ($sz_kreativ as $sz_krea) {
            if ($sz_krea['ikon1'] != NULL) {
              if ($sz_krea['category'] == 'anyaknapja') { ?>
                <div style="display: flex">
                  <a href="kezmuves.php?id=<?= $sz_krea['id'] ?>"><img class="receptkep" style="max-width: 200px" src="media/<?php echo ($sz_krea['ikon1']) ?>">
                    <div class="felirat"><?php echo ($sz_krea['name']) ?></div>
                  </a>
                </div>&nbsp;&nbsp;
              <?php } ?>
            <?php } ?>
          <?php } ?>
        </div>

      </article>
    </article>
  </main>


</body>

</html>