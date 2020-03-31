<?php
session_start();

include("auth.php");
include("database.php");

$id = $_GET['id'];
$sz_recipes = lekerdezes(
  $db,
  'select * from sz_recipes where id = :id',
  // 'select * from sz_ingredients where id = :id',
  [':id' => $id]
)[0];
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
        <a href="index.php"><img style="max-width: 20%" class="ikon" alt="logo6" src="media/logo6.png"></a>
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

  <article id="munkalap1">
    <article id="munkalap2">


      <h1 style="color: black">
        <span class=" <? $sz_recipes['name'] ?>" style="width: 180px; height: 240px;">
          <h3 style="color: black" class="card-title"><?= $sz_recipes['name'] ?></h3>
      </h1>

        <span class=" <? $sz_recipes['time'] ?>" style="width: 180px; height: 240px;">
        <div style="color: black" id="time"><?php echo($sz_recipes['time'].' perc') ?></div>
  


      <!-- <table class="masiktabla">
        <th> -->
        <h2 style="color: black">Hozzávalók</h2>
        <ul style="color: black">
          <li>Lista1</li>
          <li>Lista2</li>
          <li>Lista3</li>
          <li>Lista4</li>
        </ul>
        <!-- Hozzávalók - másik tábla - kapcsolás?? -->

        <h2>Elkészítés</h2>
        <div style="color: black">
          <?php if ($sz_recipes['description'] != '') { ?>
            <span><?= $sz_recipes['description'] ?></span>
          <?php } else { ?>
            <span>-</span>
          <?php } ?>
        </div>

        <h3>Kiegészítő információk</h3>
        <div style="color: black">
          <?php
          if ($sz_recipes['vega'] == 0) {
            $vega = "Nem vegetáriánus";
          } else {
            $vega = "Vegetáriánus";
          }
          ?>
          <?= $vega ?>

          <div style="color: black">
          <?php
          if ($sz_recipes['laktoz'] == 0) {
            $laktoz = "Laktózt tartalmaz";
          } else {
            $laktoz = "Laktózmentes";
          }
          ?>
          <?= $laktoz ?>

<?php if ($sz_recipes['image'] != ''){ ?>
  <h3>Kép</h3>
          <div class="kajakep"><img src="media/<?php echo($sz_recipes['image']) ?>"></div>
<?php } ?>


<?php if ($sz_recipes['video'] != ''){ ?>
<h3>Video</h3>
<div class="video-responsive">
<iframe <?php echo($sz_recipes['video']) ?> ></iframe>
</div>
<?php } ?>


<!-- <section id="video" class="videos" id="featured-videos">
    <div class="video-grid front-page" id="front-page-videos">
      <ul class="video-list featured">
        <li class="video featured">
          <a data-fancybox href="https://www.youtube.com/watch?v=MmVXLM97YL0&feature=youtu.be&fbclid=IwAR0nveyBgbA7iYjM1Oc2Jj07AEsSi6S3PVYEDWtQTT8m8LPa1jg2G4R_gIU" class="featured-video">
            <figure style="background-image: url(https://i.ytimg.com/vi/MmVXLM97YL0/hqdefault.jpg?sqp=-oaymwEZCNACELwBSFXyq4qpAwsIARUAAIhCGAFwAQ==&rs=AOn4CLD31tCIc_ewDB-arfRuLTgAJXXcGA);">
            <button onclick="myFunction();return false;"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/50598/video-thumb-placeholder-16-9.png" /></button>
              <figcaption>süti</figcaption>
            </figure>
          </a>
        </li>



      <script>
            function myFunction() {
                document.getElementById("video").innerHTML = "<div id='player'></div>";

                // 2. This code loads the IFrame Player API code asynchronously.
                var tag = document.createElement('script');

                tag.src = "https://www.youtube.com/iframe_api";
                var firstScriptTag = document.getElementsByTagName('script')[0];
                firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
            }

            // 3. This function creates an <iframe> (and YouTube player)
            //    after the API code downloads.
            var player;
            function onYouTubeIframeAPIReady() {
                player = new YT.Player('player', {
                    height: '390',
                    width: '640',
                    videoId: 'M7lc1UVf-VE',
                    events: {
                        'onReady': onPlayerReady,
                        'onStateChange': onPlayerStateChange
                    }
                });
            }

            // 4. The API will call this function when the video player is ready.
            function onPlayerReady(event) {
                event.target.playVideo();
            }

            // 5. The API calls this function when the player's state changes.
            //    The function indicates that when playing a video (state=1),
            //    the player should play for six seconds and then stop.
            var done = false;
            function onPlayerStateChange(event) {
                if (event.data == YT.PlayerState.PLAYING && !done) {
                    //setTimeout(stopVideo, 6000);
                    done = true;
                }
            }
            function stopVideo() {
                player.stopVideo();
            }
        </script> -->







        <!-- </th>
        <th>aaa</th>
      </table> -->

      <!-- <style>
/* unvisited link */
a:link {
    color: red;
    background-color: rgba(255, 255, 255, 0.6);
    font-weight: bold;
    font-size: 20px;
  }
  
  /* visited link */
  a:visited {
    color: red;
    background-color: rgba(255, 255, 255, 0.6);
    font-weight: bold;
    font-size: 20px;
  }
  
  /* mouse over link */
  a:hover {
    color: green;
    background-color: rgba(255, 255, 255, 0.6);
    font-weight: bold;
    font-size: 20px;
  }

/* Ideiglenes háttér */
body{
    background-color: rgb(218, 218, 218);
}
head{
    background-color: rgb(218, 218, 218);
}

#munkalap{
    /* background-image: url("pottyos.jpg"); */
    background-color: rgb(53, 43, 201);
	  width: 80%;
	  height: 100%;
    margin: 0 auto;
    padding: 2% 0% 2% 0%;
}

}
/* #munkalap_folott {
	height: 0px;
	color: rgba(0, 0, 0, 0.0);
} */

h3{
    color: black;
}
</style>
</article>
</body>
</html> -->