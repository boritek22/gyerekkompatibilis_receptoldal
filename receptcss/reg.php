<?php
include("database.php");

function letezik($kapcsolat, $username, $email) {
  $felhasznalok = lekerdezes($kapcsolat,
    "SELECT * FROM `sz_users` WHERE `username` = :username OR `email` = :email",
    [
        ":username" => $username,
        ":email" => $email
    ]
  );
  return count($felhasznalok) === 1;
}

function regisztral($kapcsolat, $email, $username, $password) {
  $db = vegrehajtas($kapcsolat,
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
    <title>Register</title>
</head>
<body class="loginpage">
    <h2 class="h2">REGISTER PAGE</h2>

	<ul>
    <?php 
	
		foreach($hibak as $hiba) {
			echo '<li style="color: red">'.$hiba.'</li>';
		}

	?>
	</ul>
<div class="loginwindow">
  <form action="" method="post">
    <div class="imgcontainer">
      <img src="media/logo4.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      
        <div><label for="email"><b>E-mail cím</b></label></div>
            <input type="text" placeholder="Enter E-mail" name="email" required>
        
        <div><label for="name"><b>Felhasználónév</b></label></div>
            <input type="text" placeholder="Enter Name" name="username" required>
        
        <div><label for="password"><b>Jelszó</b></label></div>
            <input type="password" placeholder="Enter Password" name="password" required>
    </div>

    <div class="container" style="background-color:#f1f1f1">
        <button class="cancelbtn" type="submit">Regisztrál</button>
    </div>
  </form>
</div>

    <!-- <script src="ajax.js"></script> -->
    <script src="reg.js"></script>
</body>
</html>