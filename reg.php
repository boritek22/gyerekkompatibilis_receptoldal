<?php
include("database.php");

function letezik($kapcsolat, $username, $email)
{
  $felhasznalok = lekerdezes(
    $kapcsolat,
    "SELECT * FROM `sz_users` WHERE `username` = :username OR `email` = :email",
    [
      ":username" => $username,
      ":email" => $email
    ]
  );
  return count($felhasznalok) === 1;
}

function regisztral($kapcsolat, $email, $username, $password)
{
  $db = vegrehajtas(
    $kapcsolat,
    "INSERT INTO `sz_users` (`email`, `username`, `password`) 
      values (:email, :username, :password)",
    [
      ":email"   => $email,
      ":username"   => $username,
      ":password"   => password_hash($password, PASSWORD_DEFAULT),
    ]
  );
  return $db === 1;
}

$hibak = [];
if (count($_POST) > 0) {
  $email = $_POST["email"];
  $username = $_POST["username"];
  $password = $_POST["password"];

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $hibak[] = "Hibás email cím!";
  }

  if (letezik($db, $username, $email)) {
    $hibak[] = "Már létező felhasználó!";
  }

  if (count($hibak) === 0) {
    regisztral($db, $email, $username, $password);
    header("Location: login.php");
    exit();
  }
}

?>


<!DOCTYPE html>
<html lang="hu">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="css/main.css" rel="stylesheet" type="text/css" title="alap">
  <title>Regisztráció</title>
</head>

<body>
  <article id="munkalap1">
    <!-- <h2 class="h2">REGISTER PAGE</h2> -->

    <ul>
      <?php



      foreach ($hibak as $hiba) {?>
      <div class="alert">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
      <strong><?php echo '<div style="color: black; text-align: center">' . $hiba . '</div>';?></strong>
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

          <div><label for="email"><b>E-mail cím</b></label></div>
          <input type="text" placeholder="Írd be az e-mail címed" name="email" required>

          <div><label for="name"><b>Felhasználónév</b></label></div>
          <input type="text" placeholder="Írj be egy nevet, amin szólíthatunk" name="username" required>

          <div><label for="password"><b>Jelszó</b></label></div>
          <input type="password" placeholder="Írd be a jelszavad" name="password" required>
        </div>

        <div class="container" style="background-color:#f1f1f1">
          <button class="cancelbtn" type="submit">Regisztráció</button>
        </div>
      </form>
    </div>

    <!-- <script src="ajax.js"></script> -->
    <script src="js/reg.js"></script>
  </article>

</body>

</html>