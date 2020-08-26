<?php
session_start();

include("auth.php");
include("database.php");

$id = $_GET['id'];
$sz_kommentek = lekerdezes($db, "select * from sz_kommentek k inner join sz_users u on k.userId = u.id where k.recipeId = :id", ['id' => $id]);
$sz_users = lekerdezes($db, "select * from sz_users");
$recipesQuery = lekerdezes($db, "select sz_recipes.id, sz_recipes.name from sz_recipes");
$query = lekerdezes($db, "SELECT * FROM star WHERE recipeId= '$id'");
$hozzavalok = lekerdezes(
  $db,
  "SELECT I.name, I.amount, A.mertekegyseg
  FROM sz_recipes R
  JOIN sz_ingredients I ON I.recipeId = R.id
  JOIN sz_amounts A ON I.amountId = A.id
  WHERE R.id = :id",
  ['id' => $id]
);
$sz_recipes = lekerdezes(
  $db,
  'select * from sz_recipes where id = :id',
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
              <form id="showID" action="adminshow.php" method="POST">
                <input type="hidden" name="recipeId" id="recipeId" value="<?php echo $id ?>">
                <label>Láthatóság véltoztatása</label><br>
                <select name="show" id="showId">
                  <option value="0">0 (a recept rejtve marad)</option>
                  <option value="1">1 (a recept megjelenik)</option>
                </select>
                <input type="submit" value="Láthatóság változtatása" name="submit">
              </form>
              <br>
              <div style="color: black;">vagy</div>
              <br>
              <form id="delID" action="admindel.php" method="POST">
                <input type="hidden" name="recipeId" id="recipeId" value="<?php echo $id ?>">
                <input type="submit" value="Recept törlése" name="del">
            </div>
        <?php }
        } ?>
      </div>


      <?php if ($sz_recipes['userName'] != NULL) { ?>
        <div>
          <h1 class="feltolto" style="color: black">A recept feltöltője: <?= $sz_recipes['userName'] ?></h1>
        </div>
      <?php } ?>

      <?php $time = $sz_recipes['time']; ?>
      <div style="color: black">
        <span class=" <? $sz_recipes['name'] ?>" style="width: 180px; height: 240px;">
          <h1 class="nev_ido_tav" style="color: black" class="card-title"><?= $sz_recipes['name'] ?></h1>
          <span class=" <? $time ?>" style="width: 180px; height: 240px;">
            <?php if ($time < 60) { ?>
              <small style="color: black" id="time">Elkészítési idő: <?php echo gmdate('s', $time) . ' perc' ?></small>
            <?php } else if ($time > 60 && $time % 60 > 0) { ?>
              <small style="color: black" id="time">Elkészítési idő: <?php echo gmdate('i ó\r\a s', $time) . ' perc' ?></small>
            <?php  } else if ($time == 60 || $time > 60 && $time % 60 == 0) { ?>
              <small style="color: black" id="time">Elkészítési idő: <?php echo gmdate('i', $time) . ' óra' ?></small>
            <?php } ?>
      </div>

      <table class="recept_table">
        <tr style="color: black">
          <th class="recipe_text">
            <h2 style="color: black">Hozzávalók</h2>

            <ul>
              <?php foreach ($hozzavalok as $hozzavalo) { ?>
                <li>
                  <?php echo $hozzavalo['amount'], ' ', $hozzavalo['mertekegyseg'] ?>&nbsp;
                  <?php echo $hozzavalo['name'] ?></li>
              <?php } ?>
            </ul>

          <th class="w3-content w3-display-container" class="recipe_media">
            <?php if ($sz_recipes['image'] != '') { ?>

              <div><img onerror="this.onerror=null; this.src='media/default.jpg'" alt="" class="mySlides" class="kajakep" src="media/<?php echo ($sz_recipes['image']) ?>"></div>
            <?php } else { ?>
              <img style="border: 1px solid black" class="mySlides" class="kajakep" src="media/default.jpg">
            <?php } ?>

            <?php if ($sz_recipes['video'] != '') { ?>

              <div class="video-responsive">
                <iframe style="width: 100%; height: 190px" class="mySlides" <?php echo ($sz_recipes['video']) ?>></iframe>
              </div>
            <?php } ?>

            <?php if ($sz_recipes['image'] != '' and $sz_recipes['video'] != '') { ?>
              <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
              <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
            <?php } ?>

            <?php if ($sz_recipes['category'] == 'karacsonyi') { ?>
              <h4>Hallgassatok főzés közben hangulazhoz illő zenét!</h4>
              <audio controls>
                <source src="media/karacsonyi_angyalok.mp3" type="audio/mpeg">
              </audio>
            <?php } else if ($sz_recipes['category'] == 'szilveszteri') { ?>
              <h4>Legyen buli a főzés is szilveszter napján! Táncoljatok a konyhában!</h4>
              <audio controls>
                <source src="media/kulonos_szilveszter.mp3" type="audio/mpeg">
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
        } ?>

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

        <?php if ($sz_recipes['entertainment'] != NULL || $sz_recipes['entertainment2'] != NULL) { ?>
          <h2>Végül, amíg vársz, szórakozz kicsit!</h2>
        <?php } else { ?>
          <p style="font-weight: bold">Ehhez a recepthez még nem tartozik szórakoztató tartalom. Ha játszani szeretnél, menj át másik recepthez, vagy próbáld ki a kreatív tartalmakat!</p>
        <?php } ?>

        <?php if ($sz_recipes['entertainment'] != NULL) { ?>
          <?php if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $agent = $_SERVER['HTTP_USER_AGENT'];
          }
          if (!strlen(strstr($agent, 'Chrome')) > 0) { ?>
            <h3 style="margin-left: 12%;">Játék</h3>
            <div class="wrap">
              <iframe id="mute" class="frame" <?php echo ($sz_recipes['entertainment']) ?>></iframe>
            </div>
          <?php } ?>
        <?php } else { ?>
          <div>
            <?php if ($sz_recipes['entertainment2'] != NULL) { ?>
              <h3 style="margin-left: 12%;">Mese</h3>
              <div>
                <iframe style="width: 70%; height: 220px; margin-left: 85px" <?php echo ($sz_recipes['entertainment2']) ?>></iframe>
              </div>
          <?php } else {
              echo '';
            }
          } ?>
          </div>

          <?php if ($sz_recipes['entertainment'] != NULL) { ?>
            <?php if ($sz_recipes['entertainment'] != NULL) { ?>
              <?php if (isset($_SERVER['HTTP_USER_AGENT'])) {
                $agent = $_SERVER['HTTP_USER_AGENT'];
              }
              if (strlen(strstr($agent, 'Chrome')) > 0) { ?>
                <p>Sajnos Chrome-ban csak mesét tudsz nézni, játszani nem. Ha játszani szeretnél, nyisd meg az oldalt Firefoxban vagy Internet Explorer-ben. Ha jó a mese is, érezd jól magad! 😊</p>
            <?php }
            } ?>

            <div>
              <?php if ($sz_recipes['entertainment2'] != NULL) { ?>
                <h3 style="margin-left: 12%;">Mese</h3>
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