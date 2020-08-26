<?php
session_start();

include("auth.php");
include("database.php");

$sz_recipes = lekerdezes($db, "select * from sz_recipes");
$id = $_POST['recipeId'];
?>
        <?php if (azonositott_e()) {

          $userAdmin = $_SESSION["felhasznalo"]['admin'];
          $del = $_POST['del'];
          $stmt = $db->prepare("DELETE FROM `sz_recipes` WHERE `id` =:id");
          $stmt->bindParam(':id', $id);
          $stmt->execute();
        }

        header("Location: index.php");
        die();
        ?>