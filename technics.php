<?php

session_start();

include("auth.php");
include("database.php");

$sz_technics = lekerdezes($db, "SELECT * FROM sz_technics order by name");

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
    </div>
    <article id="munkalap1">
      <article id="munkalap3">
        <h1 style="text-align:center; font-size: 40px">Konyhai műveletek</h1>

        <h2 style="font-size: 30px; text-decoration: underline;">Főzés</h2>
        <?php
        foreach ($sz_technics as $sz_technic) {
          if ($sz_technic['category'] == 'fozes') { ?>
            <div>
              <div style="font-weight: bold; font-size: 25px;"><?php echo $sz_technic['name']; ?></div>
              <div style="margin-left: 35px"><?php echo $sz_technic['description']; ?></div><br>
            </div>
          <?php } ?>
        <?php } ?>

        <h2 style="font-size: 30px; text-decoration: underline;">Sütés</h2>
        <?php
        foreach ($sz_technics as $sz_technic) {
          if ($sz_technic['category'] == 'sutes') { ?>
            <div>
              <div style="font-weight: bold; font-size: 25px;"><?php echo $sz_technic['name']; ?></div>
              <div style="margin-left: 35px"><?php echo $sz_technic['description']; ?></div><br>
            </div>
          <?php } ?>
        <?php } ?>

        <h2 style="font-size: 30px; text-decoration: underline;">Sűrítés</h2>
        <?php
        foreach ($sz_technics as $sz_technic) {
          if ($sz_technic['category'] == 'surites') { ?>
            <div>
              <div style="font-weight: bold; font-size: 25px;"><?php echo $sz_technic['name']; ?></div>
              <div style="margin-left: 35px"><?php echo $sz_technic['description']; ?></div><br>
            </div>
          <?php } ?>
        <?php } ?>

        <h2 style="font-size: 30px; text-decoration: underline;">Tésztakészítés</h2>
        <?php
        foreach ($sz_technics as $sz_technic) {
          if ($sz_technic['category'] == 'tesztakeszites') { ?>
            <div>
              <div style="font-weight: bold; font-size: 25px;"><?php echo $sz_technic['name']; ?></div>
              <div style="margin-left: 35px"><?php echo $sz_technic['description']; ?></div><br>
            </div>
          <?php } ?>
        <?php } ?>

        <h2 style="font-size: 30px; text-decoration: underline;">Tartósítás</h2>
        <?php
        foreach ($sz_technics as $sz_technic) {
          if ($sz_technic['category'] == 'tartositas') { ?>
            <div>
              <div style="font-weight: bold; font-size: 25px;"><?php echo $sz_technic['name']; ?></div>
              <div style="margin-left: 35px"><?php echo $sz_technic['description']; ?></div><br>
            </div>
          <?php } ?>
        <?php } ?>

        <h2 style="font-size: 30px; text-decoration: underline;">Hidegkonyhai eljárások</h2>
        <?php
        foreach ($sz_technics as $sz_technic) {
          if ($sz_technic['category'] == 'hidegkonyha') { ?>
            <div>
              <div style="font-weight: bold; font-size: 25px;"><?php echo $sz_technic['name']; ?></div>
              <div style="margin-left: 35px"><?php echo $sz_technic['description']; ?></div><br>
            </div>
          <?php } ?>
        <?php } ?>

        <h2 style="font-size: 30px; text-decoration: underline;">Habverés</h2>
        <?php
        foreach ($sz_technics as $sz_technic) {
          if ($sz_technic['category'] == 'habveres') { ?>
            <div>
              <div style="font-weight: bold; font-size: 25px;"><?php echo $sz_technic['name']; ?></div>
              <div style="margin-left: 35px"><?php echo $sz_technic['description']; ?></div><br>
            </div>
          <?php } ?>
        <?php } ?>

        <h2 style="font-size: 30px; text-decoration: underline;">Panírozás</h2>
        <?php
        foreach ($sz_technics as $sz_technic) {
          if ($sz_technic['category'] == 'panirozas') { ?>
            <div>
              <div style="font-weight: bold; font-size: 25px;"><?php echo $sz_technic['name']; ?></div>
              <div style="margin-left: 35px"><?php echo $sz_technic['description']; ?></div><br>
            </div>
          <?php } ?>
        <?php } ?>

        <h2 style="font-size: 30px; text-decoration: underline;">Marinálás</h2>
        <?php
        foreach ($sz_technics as $sz_technic) {
          if ($sz_technic['category'] == 'marinalas') { ?>
            <div>
              <div style="font-weight: bold; font-size: 25px;"><?php echo $sz_technic['name']; ?></div>
              <div style="margin-left: 35px"><?php echo $sz_technic['description']; ?></div><br>
            </div>
          <?php } ?>
        <?php } ?>

        <h2 style="font-size: 30px; text-decoration: underline;">Flambírozás</h2>
        <?php
        foreach ($sz_technics as $sz_technic) {
          if ($sz_technic['category'] == 'flambirozas') { ?>
            <div>
              <div style="font-weight: bold; font-size: 25px;"><?php echo $sz_technic['name']; ?></div>
              <div style="margin-left: 35px"><?php echo $sz_technic['description']; ?></div><br>
            </div>
          <?php } ?>
        <?php } ?>

        <h2 style="font-size: 30px; text-decoration: underline;">Blansírozás</h2>
        <?php
        foreach ($sz_technics as $sz_technic) {
          if ($sz_technic['category'] == 'blasnirozas') { ?>
            <div>
              <div style="font-weight: bold; font-size: 25px;"><?php echo $sz_technic['name']; ?></div>
              <div style="margin-left: 35px"><?php echo $sz_technic['description']; ?></div><br>
            </div>
          <?php } ?>
        <?php } ?>

      </article>
    </article>
  </main>
</body>

</html>