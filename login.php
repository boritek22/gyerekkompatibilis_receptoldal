<?php
include("database.php");
include("auth.php");

function ellenoriz($kapcsolat, $email, $password)
{
  $felhasznalok = lekerdezes(
    $kapcsolat,
    "SELECT * FROM `sz_users` WHERE `email` = :email",
    [":email" => $email]
  );
  if (count($felhasznalok) === 1) {
    $felhasznalo = $felhasznalok[0];
    return password_verify($password, $felhasznalo["password"])
      ? $felhasznalo
      : false;
  }
  return false;
}

session_start();

$hibak = [];
if (count($_POST) > 0) {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $felhasznalo = ellenoriz($db, $email, $password);

  if ($felhasznalo === false) { ?>
    <p><?php $hibak[] = "Hibás adatok!"; ?></p>
    </div>
<?php }

  if (count($hibak) === 0) {
    beleptet($felhasznalo);
    header("Location: index.php");
    exit();
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="css/main.css" rel="stylesheet" type="text/css" title="alap">
  <title>Bejelentkezés</title>
</head>

<body>
  <article id="munkalap1">
    <ul>
      <?php

      foreach ($hibak as $hiba) { ?>
        <div class="alert">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
          <strong><?php echo '<div style="color: black; text-align: center">' . $hiba . '</div>'; ?></strong>
        </div>
      <?php } ?>

    </ul>
    <div class="loginwindow">
      <a style="font-weight:bold; font-size:20px" href="index.php">Vissza a főoldalra</a>
      <form action="" method="post">
        <div class="imgcontainer">
          <img src="media/maciszebb.png" alt="Avatar" class="avatar">
        </div>

        <div class="container">
          <div><label for="email"><b>E-mail</b></label></div>
          <input type="text" placeholder="Írd be az e-mail címed" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : '' ?>" name="email" required>

          <div><label for="password"><b>Jelszó</b></label></div>
          <input type="password" placeholder="Írd be a jelszavad" name="password" required>

        </div>

        <div class="container" style="background-color:#f1f1f1">

          <button type="submit" class="cancelbtn">Bejelentkezés</button>
          <span class="psw"> </span>
        </div>
      </form>
      <form method="get" action="./reg.php">
        <button class="loginbtn" type="submit">Regisztráció</button>
      </form>
    </div>

  </article>
</body>

</html>