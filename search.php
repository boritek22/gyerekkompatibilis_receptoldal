<?php

include("auth.php");
include("database.php");

if (isset($_POST['submit-search'])) {
  $search = $_POST['search'];
  $item = "SELECT * FROM sz_recipes WHERE sz_recipes.show = 1 AND name LIKE '%$search%' OR description LIKE '%$search%' OR category LIKE '%$search%' OR userName LIKE '%$search%'";
  $result = lekerdezes($db, $item);
}
?>

<!DOCTYPE html>
<html lang="en">

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
    <article id="munkalap1keres">
      <article id="munkalap3keres">

        <h1 style="text-align: center;">Keresési találatok erre: <?php echo $search; ?></h1>

        <div style="margin-left: 2%; display: flex; flex-wrap: wrap;">
          <?php if (count($result) === 0) { ?>
            <h2 style="color: white">Nincs találat</h2>
          <?php } else { ?>
            <?php foreach ($result as $results) {
              if ($results['image'] != NULL) { ?>
                <div style="display: flex">
                  <a href="recipes.php?id=<?= $results['id'] ?>"><img class="receptkep" style="max-width: 200px" src="media/<?php echo ($results['image']) ?>">
                    <div class="feliratkeres"><?php echo ($results['name']) ?></div>
                  </a>
                </div>
              <?php } else { ?>
                <a href="recipes.php?id=<?= $results['id'] ?>"><img class="receptkep" style="max-width: 200px" src="media/default.jpg">
                  <div class="feliratkeres"><?php echo ($results['name']) ?></div>
                </a>
                <?php } ?>&nbsp;
              <?php } ?>
            <?php } ?>

        </div>
      </article>
    </article>

  </main>

</body>

</html>