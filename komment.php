<?php
session_start();

include("auth.php");
include("database.php");

$id = $_GET['recipeId'];
$sz_kommentek = lekerdezes($db, "select * from sz_kommentek k inner join sz_users u on k.userId = u.id");
$receptek = lekerdezes($db, "select id from sz_recipes");

$komment = $_POST['komment'];
$user = $_SESSION["felhasznalo"]['id'];
var_dump($komment);
//todo1 komment lementése
vegrehajtas($db, "INSERT INTO `sz_kommentek`(`komment`, `userId`, `recipeId`) VALUES (:komment, :userId, :recipeId)", ['komment' => $komment, 'userId' => $user['id'], 'recipeId' => $id]);


//todo2 redirect a receptre
header("Location: recipes.php?id=$id");
die();
