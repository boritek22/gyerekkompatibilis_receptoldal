<?php
session_start();

include("auth.php");
include("database.php");

$id = $_GET['id'];
// $id2 = lekerdezes($db, "select sz_recipes.id from sz_recipes");
// $recipeid = $sz_kommentek['recipeId'] = $id;
// $sz_kommentek = lekerdezes('SELECT sz_kommentek.userId, sz_kommentek.recipeId FROM sz_kommentek ((INNER JOIN sz_users ON sz_kommentek.userId = sz_users.id) INNER JOIN sz_recipes ON sz_kommentek.recipeId = sz_recipes.id)');
$sz_kommentek = lekerdezes($db, "select * from sz_kommentek k inner join sz_users u on k.userId = u.id where k.recipeId = :id", ['id' => $id]);
$sz_users = lekerdezes($db, "select * from sz_users");
$recipesQuery = lekerdezes($db, "select sz_recipes.id, sz_recipes.name from sz_recipes");
$hozzavalok = lekerdezes($db, "SELECT sz_ingredients.name FROM sz_recipes_ingredients JOIN sz_ingredients ON sz_recipes_ingredients.ingredientId=sz_ingredients.id WHERE sz_recipes_ingredients.recipeId = :id", ['id' => $id]);
$mennyisegek = lekerdezes($db, "SELECT sz_amounts.amount, sz_amounts.mertekegyseg FROM sz_recipes_ingredients JOIN sz_amounts ON sz_recipes_ingredients.amountId=sz_amounts.id WHERE sz_recipes_ingredients.ingredientId = :id", ['id' => $id]);
$sz_recipes = lekerdezes(
  $db,
  'select * from sz_recipes where id = :id',
  // 'select * from sz_ingredients where id = :id',
  ['id' => $id]
)[0];
if (azonositott_e()) {
  $felhasznalo = $_SESSION["felhasznalo"];
  $userAdmin = $_SESSION["felhasznalo"]['admin'];
}
?>

<!DOCTYPE html>
<html lang="hu">

<head>
  <meta charset="utf-8">
  <title>Játssz az Étellel!</title>
  <link rel="icon" href="media/logo9.png">
  <link href="css/main.css" rel="stylesheet" type="text/css" title="alap">
  <script src="js/menu.js"></script>
  <link type="text/css" rel="stylesheet" href="css/style.css">
  <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>


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
          <form action="/search.php" 4>
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
      <!-- <li><a href="index.php"><img style="max-width: 20%" class="ikon" alt="logo6" src="media/logo6.png"></a></li> -->
      <a href="reggeli.php" class="aktiv">Reggeli</a>
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

  <article id="munkalap1">
    <article id="munkalap2">

      <div>
        <?php if (azonositott_e()) {
          if ($userAdmin == 1) { ?>
            <div>
              <form action="admin.php?recipeId=<?= $id ?>" method="POST">
                <select name="show" id="show">
                  <option value="0">0 (a recept rejtve marad)</option>
                  <option value="1">1 (a recept megjelenik)</option>
                </select>
                <button>Láthatóság változtatása</button>
              </form>
            </div>
        <?php }
        } ?>
      </div>

      <?php if ($sz_recipes['userName'] != NULL) { ?>
        <div>
          <h1 class="feltolto" style="color: black">A recept feltöltője: <?= $sz_recipes['userName'] ?></h1>
        </div>
      <?php } ?>


      <?php $time = $sz_recipes['time'] ?>
      <div style="color: black">
        <span class=" <? $sz_recipes['name'] ?>" style="width: 180px; height: 240px;">
          <h1 class="nev_ido_tav" style="color: black" class="card-title"><?= $sz_recipes['name'] ?></h1>
          <span class=" <? $time ?>" style="width: 180px; height: 240px;">
            <?php if ($time < 60) { ?>
              <small style="color: black" id="time">Elkészítési idő: <?php echo gmdate('s', $time) . ' perc' ?></small>
            <?php } else if ($time > 60) { ?>
              <small style="color: black" id="time">Elkészítési idő: <?php echo gmdate('i ó\r\a s', $time) . ' perc' ?></small>
            <?php  } else if ($time = 60) { ?>
              <small style="color: black" id="time">Elkészítési idő: <?php echo gmdate('i', $time) . ' óra' ?></small>
            <?php } ?>
      </div>



      <table class="recept_table">
        <tr style="color: black">
          <th class="recipe_text">
            <h2 style="color: black">Hozzávalók</h2>

            <!-- Hozzávalók - másik tábla - kapcsolás?? -->
            <ul>
              <?php foreach ($hozzavalok as $hozzavalo) { ?>
                <?php foreach ($mennyisegek as $mennyiseg) { ?>
                  <li>
                    <?php echo $mennyiseg['amount'], ' ', ($mennyiseg['mertekegyseg']) ?>
                  <?php } ?>
                  <?php echo $hozzavalo['name'] ?></li>
                <?php } ?>
            </ul>





          <th class="w3-content w3-display-container" class="recipe_media">
            <?php if ($sz_recipes['image'] != '') { ?>
              <!-- <h3>Kép</h3> -->
              <div><img class="mySlides" class="kajakep" src="media/<?php echo ($sz_recipes['image']) ?>"></div>
            <?php } ?>


            <?php if ($sz_recipes['video'] != '') { ?>
              <!-- <h3>Video</h3> -->
              <div class="video-responsive">
                <iframe style="width: 100%; height: 190px" class="mySlides" <?php echo ($sz_recipes['video']) ?>></iframe>
              </div>
            <?php } ?>

            <?php if ($sz_recipes['image'] != '' and $sz_recipes['video'] != '') { ?>
              <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
              <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
            <?php } ?>

            <?php if ($sz_recipes['category'] == 'karacsonyi') { ?>
              <audio controls>
                <source src="karacsonyi_angyalok.mp3" type="audio/mpeg">
                <source src="feherszakallu.mp3" type="audio/mpeg">
              </audio>
            <?php } ?>
        </tr>


        <tr>
          <td colspan="2">
            <h2>Elkészítés</h2>
            <div style="color: black; margin-left: 25px;">
              <?php if ($sz_recipes['description'] != '') { ?>
                <span><?= $sz_recipes['description'] ?></span>
              <?php } else { ?>
                <span>-</span>
              <?php } ?>
            </div>

            <h3>Kiegészítő információk</h3>
            <div style="color: black; margin-left: 25px;">
              <?php
              if ($sz_recipes['vega'] == 0) {
                $vega = "Az étel nem vegetáriánus.";
              } else {
                $vega = "Az étel vegetáriánus.";
              }
              ?>
              <?= $vega ?>
            </div>

            <div style="color: black; margin-left: 25px;">
              <?php
              if ($sz_recipes['laktoz'] == 0) {
                $laktoz = "Az étel laktózt tartalmaz.";
              } else {
                $laktoz = "Az étel laktózt nem tartalmaz, laktózmentes.";
              }
              ?>
              <?= $laktoz ?>
            </div>
          </td>
        </tr>
      </table>
      <br>
      <div style="color:black">
        <?php if (azonositott_e()) { ?>
          <h3 style="margin-bottom: 0;">Mondd el a véleményed másoknak is!</h3>
          <form action="komment.php?recipeId=<?= $id ?>" method="POST">
            <textarea name="komment"></textarea>
            <button>Kommentelek</button></form>
          <?php
          foreach ($sz_kommentek as $sz_komment) {
            if ($sz_komment['komment'] != NULL || $sz_komment['komment'] != '') {
          ?>
              <div style="font-size: 22px; font-weight: bold;"><?php echo ($sz_komment['username']) ?></div>
              <div><?php echo ($sz_komment['komment']) ?></div>

        <?php }
          }
        }

        // $username = $sz_users['username'];
        // $komment = $sz_kommentek['komment'];

        // echo ($komment);
        ?>

        <!-- <br>
        <button><a href="like.php?type=sz_recipes&id=<?php echo $sz_recipes['id']; ?>">Like</a>
        </button>
        <button>Dislike</button> -->






        <?php if (azonositott_e()) { ?>
          <div class="container">
            <h3 style="margin-bottom: 5px; margin:-left: 0;">Értékeld a receptet!</h3>
            <div style="margin-top: 0" class="rate">
              <div id="1" class="btn-1 rate-btn"></div>
              <div id="2" class="btn-2 rate-btn"></div>
              <div id="3" class="btn-3 rate-btn"></div>
              <div id="4" class="btn-4 rate-btn"></div>
              <div id="5" class="btn-5 rate-btn"></div>
            </div>
            <br>
            <div class="box-result">
              <?php
              $query = lekerdezes($db, "SELECT * FROM star WHERE recipeId= '$id'");
              foreach ($query as $data) {
                $rate_db[] = $data;
                $sum_rates[] = $data['rate'];
              }
              if (@count($rate_db)) {
                $rate_times = count($rate_db);
                $sum_rates = array_sum($sum_rates);
                $rate_value = $sum_rates / $rate_times;
                $rate_bg = (($rate_value) / 5) * 100;
              } else {
                $rate_times = 0;
                $rate_value = 0;
                $rate_bg = 0;
              }
              // foreach ($felhasznalo as $felhasznalok){
              //   echo $felhasznalok;
              // }

              // echo $felhasznalo['id'];

              //kiegészíteni az adott receptre
              ?>
              <div class="result-container">
                <div class="rate-bg" style="width:<?php echo $rate_bg; ?>%"></div>
                <div class="rate-stars"></div>
              </div>
              <p style="margin:5px 0px; font-size:16px; text-align:center">Rated <strong id="rate_value"><?php echo substr($rate_value, 0, 3); ?></strong> out of <semmi id="rate_times"><?php echo $rate_times; ?></semmi> Review(s)</p>
            </div>
          </div>
        <?php } ?>
        <br>

        <div>Ha valamelyik receptben szereplő konyhai szakkifejezést nem érted, kattints <a style="font-weight: bold;" href="technics.php">ide</a> magyarázatért!</div>
        <br>

        <h2>Végül, amíg vársz, szórakozz kicsit!</h2>
        <p>Sajnos Chrome-ban csak mesét tudsz nézni, játszani nem. Ha játszani szeretnél, nyisd meg az oldalt Firefoxban. Ha jó a mese is, érezd jól magad! 😊</p>

        <style>
          .wrap {
            width: 320px;
            height: 192px;
            padding: 0;
            overflow: hidden;
            margin-left: 20%;
          }

          .frame {
            width: 1280px;
            height: 786px;
            border: 0;

            -ms-transform: scale(0.25);
            -moz-transform: scale(0.25);
            -o-transform: scale(0.25);
            -webkit-transform: scale(0.25);
            transform: scale(0.25);

            -ms-transform-origin: 0 0;
            -moz-transform-origin: 0 0;
            -o-transform-origin: 0 0;
            -webkit-transform-origin: 0 0;
            transform-origin: 0 0;
          }
        </style>

        <script>
          var player;

          function onYouTubeIframeAPIReady() {
            player = new YT.Player('mute', {
              events: {
                'onReady': onPlayerReady
              }
            });
          }

          function onPlayerReady(event) {
            player.mute();
            player.playVideo();
          }
        </script>

        <?php if ($sz_recipes['entertainment'] != NULL) { ?>
          <?php if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $agent = $_SERVER['HTTP_USER_AGENT'];
          }
          if (strlen(strstr($agent, 'Firefox')) > 0) { ?>
            <h3 style="margin-left: 12%;">Játék</h3>
            <div class="wrap">
              <iframe id="mute" class="frame" <?php echo ($sz_recipes['entertainment']) ?>></iframe>
            </div>
          <?php } ?>
        <?php } else {
          echo '';
        } ?>

        <?php if ($sz_recipes['entertainment'] != NULL) { ?>
          <h3 style="margin-left: 12%;">Mese</h3>

          <div>
            <?php if ($sz_recipes['entertainment2'] != NULL) { ?>
              <!-- <h3>Video</h3> -->
              <div>
                <iframe style="width: 70%; height: 220px; margin-left: 85px" <?php echo ($sz_recipes['entertainment2']) ?>></iframe>
              </div>
            <?php } ?>
          </div>
        <?php } else {
          echo '';
        } ?>

        <script>
          $(function() {
            $('.rate-btn').hover(function() {
              $('.rate-btn').removeClass('rate-btn-hover');
              var therate = $(this).attr('id');
              for (var i = therate; i >= 0; i--) {
                $('.btn-' + i).addClass('rate-btn-hover');
              };
            });

            $('.rate-btn').click(function() {
              var therate = $(this).attr('id');
              var dataRate = 'act=rate&recipeId=<?php echo $id; ?>&rate=' + therate;
              $('.rate-btn').removeClass('rate-btn-active');
              for (var i = therate; i >= 0; i--) {
                $('.btn-' + i).addClass('rate-btn-active');
              };
              $.ajax({
                type: "POST",
                url: "ajax.php",
                data: dataRate,
                success: function() {
                  location.reload();
                }
                // success:function(data){
                //   valtozo = JSON.parse(data);
                //   console.log(valtozo);
                //   $('#rate_value').innerHTML=valtozo['rate_value'];
                //   $('.rate_bg').innerHTML=valtozo['rate_bg'];
                //   $('#rate_times').innerHTML=valtozo['rate_times'];
                // }
              });
            });
          });
        </script>










      </div>

      <script>
        var slideIndex = 1;
        showDivs(slideIndex);

        function plusDivs(n) {
          showDivs(slideIndex += n);
        }

        function showDivs(n) {
          var i;
          var x = document.getElementsByClassName("mySlides");
          if (n > x.length) {
            slideIndex = 1
          }
          if (n < 1) {
            slideIndex = x.length
          }
          for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
          }
          x[slideIndex - 1].style.display = "block";
        }
      </script>

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
</style>-->
    </article>
    <img id="labjegyzet" src="media/macikkk.png" alt="">

  </article>

  <style>
    .mySlides {
      display: none;
    }
  </style>
</body>

</html>