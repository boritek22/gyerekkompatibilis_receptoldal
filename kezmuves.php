<?php

session_start();

include("auth.php");
include("database.php");

$id = $_GET['id'];

$sz_kezmuves = lekerdezes(
  $db,
  'select * from sz_kreativ where id = :id',
  ['id' => $id]
)[0];
if (azonositott_e()) {
}
?>

<!DOCTYPE html>
<html lang="hu">

<head>
  <meta charset="utf-8">
  <title>Szilveszter</title>
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
  <main style="color: black" class="tartalom">
    </div>
    <article id="munkalap1kreativ">
      <article id="munkalap3kreativ">

        <h1 style="text-align:center" style="color: black" class="card-title"><?= $sz_kezmuves['name'] ?></h1>

        <div style="text-align: center;">
          <?php echo ($sz_kezmuves['description']) ?>
        </div>
        <br>

        <?php if ($sz_kezmuves['image1'] != "NULL") { ?>}
        <div class="container">
          <div class="mySlides">
            <div class="numbertext">1 / 6</div>
            <?php if ($sz_kezmuves['image1'] != '') { ?>
              <img src="media/<?php echo ($sz_kezmuves['image1']) ?>" style="width:100%">
            <?php } ?>
          </div>

          <div class="mySlides">
            <div class="numbertext">2 / 6</div>
            <?php if ($sz_kezmuves['image2'] != '') { ?>
              <img src="media/<?php echo ($sz_kezmuves['image2']) ?>" style="width:100%">
            <?php } ?>
          </div>

          <div class="mySlides">
            <div class="numbertext">3 / 6</div>
            <?php if ($sz_kezmuves['image3'] != '') { ?>
              <img src="media/<?php echo ($sz_kezmuves['image3']) ?>" style="width:100%">
            <?php } ?>
          </div>

          <div class="mySlides">
            <div class="numbertext">4 / 6</div>
            <?php if ($sz_kezmuves['image4'] != '') { ?>
              <img src="media/<?php echo ($sz_kezmuves['image4']) ?>" style="width:100%">
            <?php } ?>
          </div>

          <div class="mySlides">
            <div class="numbertext">5 / 6</div>
            <?php if ($sz_kezmuves['image5'] != "NULL") { ?>
              <img src="media/<?php echo ($sz_kezmuves['image5']) ?>" style="width:100%">
            <?php } else { ?>
              <img src="media/<?php echo ($sz_kezmuves['dia']) ?>" style="width:100%">
            <?php } ?>
          </div>

          <div class="mySlides">
            <div class="numbertext">6 / 6</div>
            <?php if ($sz_kezmuves['image6'] != "NULL") { ?>
              <img src="media/<?php echo ($sz_kezmuves['image6']) ?>" style="width:100%">
            <?php } else { ?>
              <img src="media/<?php echo ($sz_kezmuves['dia']) ?>" style="width:100%">
            <?php } ?>
          </div>

          <a class="prev" onclick="plusSlides(-1)">❮</a>
          <a class="next" onclick="plusSlides(1)">❯</a>

          <div class="caption-container">
            <p id="caption"></p>
          </div>

          <div class="row">
            <div class="column">
              <?php if ($sz_kezmuves['ikon1'] != '') { ?>
                <img class="demo cursor" src="media/<?php echo ($sz_kezmuves['ikon1']) ?>" style="width:100%" onclick="currentSlide(1)" alt="Rajzolj zsiráfot!">
              <?php } ?>
            </div>
            <div class="column">
              <?php if ($sz_kezmuves['ikon2'] != '') { ?>
                <img class="demo cursor" src="media/<?php echo ($sz_kezmuves['ikon2']) ?>" style="width:100%" onclick="currentSlide(2)">
              <?php } ?>
            </div>
            <div class="column">
              <?php if ($sz_kezmuves['ikon3'] != '') { ?>
                <img class="demo cursor" src="media/<?php echo ($sz_kezmuves['ikon3']) ?>" style="width:100%" onclick="currentSlide(3)">
              <?php } ?>
            </div>
            <div class="column">
              <?php if ($sz_kezmuves['ikon4'] != '') { ?>
                <img class="demo cursor" src="media/<?php echo ($sz_kezmuves['ikon4']) ?>" style="width:100%" onclick="currentSlide(4)">
              <?php } ?> </div>
            <div class="column">
              <?php if ($sz_kezmuves['ikon5'] != "NULL") { ?>
                <img class="demo cursor" src="media/<?php echo ($sz_kezmuves['ikon5']) ?>" style="width:100%" onclick="currentSlide(5)">
              <?php } else { ?>
                <img class="demo cursor" src="media/<?php echo ($sz_kezmuves['dia2']) ?>" style="width:100%">
              <?php } ?>
            </div>
            <div class="column">
              <?php if ($sz_kezmuves['ikon6'] != "NULL") { ?>
                <img class="demo cursor" src="media/<?php echo ($sz_kezmuves['ikon6']) ?>" style="width:100%" onclick="currentSlide(6)">
              <?php } else { ?>
                <img class="demo cursor" src="media/<?php echo ($sz_kezmuves['dia2']) ?>" style="width:100%">
              <?php } ?>
            </div>
          </div>
        </div>
      <?php } else { ?>
        <div style="text-align: center"> <?php echo ($sz_kezmuves['video']) ?></div>
      <?php  } ?>

      </article>
    </article>

  </main>

  <script>
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("demo");
      var captionText = document.getElementById("caption");
      if (n > slides.length) {
        slideIndex = 1
      }
      if (n < 1) {
        slideIndex = slides.length
      }
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex - 1].style.display = "block";
      dots[slideIndex - 1].className += " active";
      captionText.innerHTML = dots[slideIndex - 1].alt;
    }
  </script>

</html>

</body>

</html>