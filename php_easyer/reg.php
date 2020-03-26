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
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>

	<ul>
    <?php 
	
		foreach($hibak as $hiba) {
			echo '<li style="color: red">'.$hiba.'</li>';
		}

	?>
	</ul>
	
	<br>
    <form action="" method="post">
        <label>
            Email cím
            <input type="email" name="email">
        </label>
        <br />
        <label>
            Felhasználónév
            <input type="text" name="username">
        </label>
        <br />
        <label>
            Jelszó
            <input type="password" name="password" required> <br>
        </label>

        <button type="submit">Regisztrál</button>
    </form>

    <!-- <script src="ajax.js"></script> -->
    <script src="reg.js"></script>
</body>
</html>