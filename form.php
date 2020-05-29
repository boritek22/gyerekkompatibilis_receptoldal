<?php
session_start();

include("auth.php");
include("database.php");
$sz_recipes = lekerdezes($db, "select * from sz_recipes");
// $hozzavalok = lekerdezes($db, "SELECT sz_ingredients.name FROM sz_recipes_ingredients JOIN sz_ingredients ON sz_recipes_ingredients.ingredientId=sz_ingredients.id");
// $mennyisegek = lekerdezes($db, "SELECT sz_amounts.amount, sz_amounts.mertekegyseg FROM sz_recipes_ingredients JOIN sz_amounts ON sz_recipes_ingredients.amountId=sz_amounts.id");
$mennyisegek = lekerdezes($db, "select distinct amount from sz_ingredients");
$mertekegysegek = lekerdezes($db, "select distinct mertekegyseg from sz_amounts");
$hozzavalok = lekerdezes($db, "select distinct name from sz_ingredients");

if (azonositott_e()) {
  $userId = $_SESSION["felhasznalo"]['id'];
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
      <a href="kreativ.php">Kreatív</a>
    </div>
  </nav>


  <a href="semmi"></a>
  <main class="tartalom">
    <!-- <div id="munkalap_folott"> -->
    </div>
    <article id="munkalap1">
      <article id="munkalap3">
        <?php if (azonositott_e()) { ?>
        <h3 style="text-align: center">Kedves <?php echo $_SESSION["felhasznalo"]['username']; ?>!</h3>
          <div style="margin-left: 4%; margin-right: 4%; text-align: center;">Köszönjük, hogy recepteddel bővíted és szinesíted az oldalt! Arra kérlek, hogy a feltöltésnél gondolj a gyermekekre is. Olyan receptet tölts csak fel, mely elkészítését ők is élveznék, illeetve a leírásban írd le, ők mit tudnak segíteni. Hiszen ez mind értük van!</div>
        <form enctype="multipart/form-data" style="padding: 30px" action="addrecipe.php" method="POST">
            <div>
              <label>Ezzel a felhasználóval küldöd be a receptet:</label><br>
              <div style="font-size: 25px"><?php echo $_SESSION["felhasznalo"]['username']; ?></div>
              <br>
              <br>
              <div>A <sup style="color: red">*</sup>-gal jelölt mezőket kötelező kitölteni!</div><br>
            </div>
            <div>
              <label>Kategória <sup style="color: red">*</sup></label><br>
              <select name="category" id="categoryID">
                <option value="reggeli">reggeli</option>
                <option value="ebed">ebéd</option>
                <!-- <option value="leves">leves</option> -->
                <!-- <option value="eloetel">előétel</option> -->
                <!-- <option value="foetel">főétel</option> -->
                <option value="edesseg">édesség</option>
                <option value="sossag">sós finomság</option>
                <option value="karacsonyi">karácsonyi</option>
                <option value="szulinapi">szülinapi</option>
                <option value="husveti">húsvéti</option>
                <option value="halloweeni">halloweeni</option>
                <option value="szilveszteri">szilveszteri</option>
                <option value="ital">ital</option>
              </select>
            </div>
            <br>
            <div>
              <label for="fname">Név <sup style="color: red">*</sup><br></label>
              <input name="name"  required>
            </div>
            <br>

            <div id="hozzavalos">
              <label for="fname">Hozzávalók <sup style="color: red">*</sup></label><br>

              <input list="amounts" name="amounts[0]" placeholder="mennyiségek" type="number" min="1" required>
              <datalist>
                <?php
                foreach ($mennyisegek as $mennyiseg) {
                  echo '<option value =\'' . $mennyiseg['amount'] . '\'>';
                }
                ?>
              </datalist>

              <input list="mertekek" name="mertekek[0]" placeholder="mértékegységek" required>
              <datalist id="mertekek">
                <?php
                foreach ($mertekegysegek as $mertekegyseg) {
                  echo '<option value =\'' . $mertekegyseg['mertekegyseg'] . '\'><br>';
                }
                ?>
              </datalist>

              <input list="ingredients" name="ingredients[0]" placeholder="hozzávalók" required>
              <datalist id="ingredients">
                <?php
                foreach ($hozzavalok as $hozzavalo) {
                  echo '<option value =\'' . $hozzavalo['name'] . '\'><br>';
                }
                ?>
              </datalist><br>
            </div>
            <div name="add" id='gomb'>+ Hozzáad</div>
            <br>

            <div>
              <label for="fname">Leírás <sup style="color: red">*</sup></label><br>
              <textarea name="description" required></textarea>
              <div>
                <br>

                <div>
                  Vegetáriánus? <sup style="color: red">*</sup><br>
                  <label>
                    <input type="radio" name="vega" value="igen" required>
                    Igen
                  </label>
                  <label>
                    <input type="radio" name="vega" value="nem">
                    Nem
                    </input>
                </div>
                <br>

                <div>
                  Laktózmentes? <sup style="color: red">*</sup><br>
                  <label>
                    <input type="radio" name="laktoz" value="igen" required>
                    Igen
                  </label>
                  <label>
                    <input type="radio" name="laktoz" value="nem">
                    Nem
                    </input>
                </div>
                <br>

                <div>
                  <!-- csak szám lehet -->
                  <label for="fname">Elkészítési idő, percben megadva<sup style="color: red">*</sup></label><br>
                  <input type="number" name="time" min="1" max="1439" required> perc
                </div>
                <br>
                <div class="form-group">
                  <label><i class="fa fa-upload" aria-hidden="true"></i>Ide töltsd fel a képet az ételről!</label><br>
                  <input type="file" id="image" name="image" class="form-control">
                </div>
                <br>

                <div>
                  <label>Ide töltsd fel a videót az étel készüléséről!</label>
                  <div class="popup" onclick="myFunction1()"><sup>🛈</sup>
                    <span style="width: 400px" class="popuptext" id="myPopup1">
                      <ol>
                        <li>Keress rá a videóra YouTube-on!</li>
                        <li>Indítsd el!</li>
                        <li>Kattints jobb gommbal a videóra!</li>
                        <li>Kattints rá a "beágyazási kód másolása" legetőségre (felülről a 4.)!</li>
                        <li>Illeszd be ide!</li>
                      </ol>
                    </span>
                  </div>
                  <div>
                    <input name="video" class="form-control">

                  </div>

                  <br>

                  <div>
                  <label>Ide tölthetsz fel szórakoztató játékot a gyerekekeknek!</label>
                  <div class="popup" onclick="myFunction2()"><sup>🛈</sup>
                    <span style="width: 400px" class="popuptext" id="myPopup2">
                      <ol>
                        <li>Keress rá a https://www.g8-games.com/ oldalra!</li>
                        <li>Válassz ki egy játékot!</li>
                        <li>Tekerj lejjebb és nyomd meg a "Share" gombot!</li>
                        <li>Másold ki az "Add to your website:" felirat alatti szövegrészt!</li>
                        <li>Illeszd be ide!</li>
                      </ol>
                    </span>
                  </div>
                  <div>
                    <input name="entertainment" class="form-control">
                  </div>
                  <br>
                  
                  <div>
                  <label>Ide tölthetsz fel mesét a gyerekekeknek!</label>
                  <div class="popup" onclick="myFunction3()"><sup>🛈</sup>
                    <span style="width: 400px" class="popuptext" id="myPopup3">
                      <ol>
                        <li>Keress rá a videóra YouTube-on!</li>
                        <li>Indítsd el!</li>
                        <li>Kattints jobb gommbal a videóra!</li>
                        <li>Kattints rá a "beágyazási kód másolása" legetőségre (felülről a 4.)!</li>
                        <li>Illeszd be ide!</li>
                      </ol>
                    </span>
                  </div>
                  <div>
                    <input name="entertainment2" class="form-control">
                  </div>
                  <br>
                  
                  <!-- image, video, entertainment, slidepic, userId -->
                  <input type="submit" value="Recept hozzáadása" name="submit">
          </form>
        <?php } else { ?> <div style="margin-left: 4%"> <?php echo "Receptet csak bejelentkezett felhasználók tölthetnek fel."; ?> </div>
        <?php } ?>

        </div>
      </article>
    </article>


    <script>
      // When the user clicks on div, open the popup
      function myFunction1() {
        var popup = document.getElementById("myPopup1");
        popup.classList.toggle("show");
      }
    </script>

    <script>
      // When the user clicks on div, open the popup
      function myFunction2() {
        var popup = document.getElementById("myPopup2");
        popup.classList.toggle("show");
      }
    </script>

    <script>
      // When the user clicks on div, open the popup
      function myFunction3() {
        var popup = document.getElementById("myPopup3");
        popup.classList.toggle("show");
      }
    </script>


    <style>
      /* Popup container - can be anything you want */
      .popup {
        position: relative;
        display: inline-block;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      /* The actual popup */
      .popup .popuptext {
        visibility: hidden;
        width: 160px;
        background-color: #555;
        color: #fff;
        text-align: left;
        border-radius: 6px;
        padding: 8px 0;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        left: 50%;
        margin-left: -80px;
      }

      /* Popup arrow */
      .popup .popuptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 20%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #555 transparent transparent transparent;
      }

      /* Toggle this class - hide and show the popup */
      .popup .show {
        visibility: visible;
        -webkit-animation: fadeIn 1s;
        animation: fadeIn 1s;
      }

      /* Add animation (fade in the popup) */
      @-webkit-keyframes fadeIn {
        from {
          opacity: 0;
        }

        to {
          opacity: 1;
        }
      }

      @keyframes fadeIn {
        from {
          opacity: 0;
        }

        to {
          opacity: 1;
        }
      }
    </style>


    <script>
      var counter = 1;
      $('#gomb').click(function () {
        $.ajax({
          type: "POST",
          url: "hozzaad.php",
          success: function(data) {
            var formatted =  data.replace(/~/g, counter);
            // var formatted = data.split("~").join(`${counter}`);
            counter += 1;
            // var divtartalma = $('#hozzavalos').html();
            // $('#hozzavalos').html(divtartalma + formatted);
            $( "#hozzavalos" ).append( formatted );
          }
        });
      });
    </script>
    
</body>