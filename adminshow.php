<?php
session_start();

include("auth.php");
include("database.php");

$sz_recipes = lekerdezes($db, "select * from sz_recipes");
$id = $_POST['recipeId'];
?>
        <?php if (azonositott_e()) {

          $userAdmin = $_SESSION["felhasznalo"]['admin'];
          $show = $_POST['show'];
          vegrehajtas($db, "UPDATE `sz_recipes` SET `show`= :show where `id` =  :id", ['show' => $show, 'id' => $id]);
        }

        header("Location: index.php");
        die();
        ?>