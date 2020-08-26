<!-- FOR RATE -->
<?php
session_start();

include("auth.php");
include("database.php");

if ($_POST['act'] == 'rate') {
	$felhasznalo = $_SESSION["felhasznalo"]['id'];
	$therate = $_POST['rate'];
	$thepost = $_POST['recipeId'];
	$query = lekerdezes($db, "SELECT * FROM star where userId= '$felhasznalo' AND recipeId= '$thepost' ");
	foreach ($query as $data) {
		$rate_db[] = $data;
	}

	if (@count($rate_db) == 0) {
		vegrehajtas($db, "INSERT INTO star (recipeId, userId, rate)VALUES('$thepost', '$felhasznalo', '$therate')");
	} else {
		vegrehajtas($db, "UPDATE star SET rate= '$therate' WHERE userId = '$felhasznalo'");
	}
}
$query = lekerdezes($db, "SELECT * FROM star WHERE recipeId= '$thepost'");
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
echo json_encode(array("rate_times" => $rate_times, "rate_value" => $rate_value, "rate_bg" => $rate_bg));
