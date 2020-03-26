<?php

session_start();

include("auth.php");
include("database.php");
$MenuItems = lekerdezes($db, "select * from MenuItems");

//ETTŐL LÁTSZIK AZ AMI BEJELENTKEZÉS UTÁN VAN
if (azonositott_e()) {
}

?>

<!DOCTYPE html>
<html lang="hu">

<head>
  <meta charset="utf-8">
  <title>Főoldal</title>
  <link rel="icon" href="media/logo5.png">
  <link href="css/main.css" rel="stylesheet" type="text/css" title="alap">
  <script src="js/menu.js"></script>
</head>

<body>
  <nav>
    <div style="height:50px;">
      <div class="menu" id="mainmenu">
        <!-- <a href="index.html"><img style="max-width: 20%" class="ikon" alt="logo6" src="media/logo6.png"></a> -->
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
        <table>
          <th>
            <div class="search-container">
              <form action="/action_page.php">
                <input type="text" placeholder="Search.." name="search">
          </th>
          <th>
            <button class="searchbtn" type="submit"><i>Keres</i></button>
          </th>
          <th>&nbsp;</th>
          </form>
      </div>
      <th>
      <?php if(!azonositott_e()) { ?>
        <form method="get" action="./login.php">
            <button class="loginbtn" type="submit">Login/Register</button>
        </form>
        <?php } ?>

        <?php if(azonositott_e()) { ?>
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
      <a href="index.html">Még egy menüpont</a>
        <div class="dropdown">
          <button class="dropbtn">Rólunk
          </button>
          <div class="content">
            <a href="bemutatkozas.html">Bemutatkozás</a>
            <a href="kulonleges.html">Amiben mások vagyunk</a>
            <a href="eszkozok.html">Taneszközök</a>
          </div>
        </div>
        <a href="galeria.html">Galéria</a>
        <a href="kapcsolat.html">Kapcsolat</a>
  </nav>


  <div class="slideshow-container">

    <div class="mySlides fade">
      <a href="https://www.google.com"><img src="media/img_nature_wide.jpg" style="width:100%">
    </div>

    <div class="mySlides fade">
      <a href="https://www.google.com"><img src="media/img_snow_wide.jpg" style="width:100%">
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
        <h2>Zelk Zoltán</h2>
        <h3>Nem érem el a kilincset</h3>
        <p>Nem érem el a kilincset,</p>
        <p>ha elérem is, hiába:</p>
        <p>anya elvitte a kulcsot</p>
        <p>és az ajtó be van zárva. </p>

        <p>Kinézhetnék az ablakon, </p>
        <p>azértse nézek ki máma: </p>
        <p>az udvaron, én már láttam, </p>
        <p>nincs más, csak egy csúnya láda.</p>

        <p>Anya, apa gyárba mennek </p>
        <p>és bezárnak minden reggel, </p>
        <p>azt hazudják, munka nélkül </p>
        <p>nem élhet a szegény ember... </p>

        <p>Mindig, mindig csak hazudnak, </p>
        <p>azért, hogy én itt maradjak, </p>
        <p>azért, hogy a sok szép géppel </p>
        <p>csak ők ketten játszhassanak! </p>

        <p>Nekik dudál a gyár reggel, </p>
        <p>hosszú kémény nekik füstöl: </p>
        <p>szép feketék csak ők lesznek </p>
        <p>a koromtól meg a füsttől. </p>

        <p>Szombat este borítékban </p>
        <p>képpel rajzolt pénzt is hoznak,</p>
        <p>én meg csak az asztalt rúgom, </p>
        <p>sírva, hogy ők milyen rosszak...</p>

        <p>De ha eztán sem visznek el, </p>
        <p>hiába keltenek reggel: </p>
        <p>úgy csinálok, mint a halott, </p>
        <p>hadd sírjanak ők is egyszer! </p>
        </div>
        <p></p>

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
      if (slideIndex > slides.length) { slideIndex = 1 }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex - 1].style.display = "block";
      dots[slideIndex - 1].className += " active";
      setTimeout(showSlides, 2000); // Change image every 2 seconds
    }
  </script>

  <script>
    // Get the modal
    var modal = document.getElementById('page');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>

</body>

</html>