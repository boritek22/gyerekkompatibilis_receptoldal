<?php
include("database.php");
include("auth.php");

function ellenoriz($kapcsolat, $email, $password) {
  $felhasznalok = lekerdezes($kapcsolat,
    "SELECT * FROM `sz_users` WHERE `email` = :email",
    [ ":email" => $email ] 
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

  if ($felhasznalo === false) {
    $hibak[] = "Hibás adatok!";
  }

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
  <title>Login</title>
</head>
<body>
  
<h2>LOGIN PAGE</h2>
	
  <ul>
    <?php 
	
		foreach($hibak as $hiba) {
			echo '<li style="color: red">'.$hiba.'</li>';
		}

	?>
	</ul>

  <form action="" method="post">
      <div class="imgcontainer">
        <span onclick="document.getElementById('page').style.display='none'" class="close"
          title="Close Modal">&times;</span>
        <img src="media/logo4.png" alt="Avatar" class="avatar">
      </div>

      <div class="container">
        <div><label for="uname"><b>E-mail</b></label></div>
        <input type="text" placeholder="Enter E-mail" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : '' ?>" name="email" required>

        <div><label for="psw"><b>Password</b></label></div>
        <input type="password" placeholder="Enter Password" name="password" required>

      </div>

      <div class="container" style="background-color:#f1f1f1">
        <button type="button" onclick="document.getElementById('page').style.display='none'"
          class="cancelbtn">Cancel</button>
          <button type="submit" class="submitbtn">Login</button>
        <span class="psw"> </span>
      </div>
    </form>
    <form method="get" action="./reg.php">
            <button class="loginbtn" type="submit">Register</button>
    </form>
  </div>



</body>
</html>