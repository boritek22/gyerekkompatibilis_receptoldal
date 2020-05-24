<?php
session_start();

include("auth.php");
include("database.php");

// $id = $_GET['recipeId'];
// $sz_kommentek = lekerdezes($db, "select * from sz_kommentek k inner join sz_users u on k.userId = u.id");
// $receptek = lekerdezes($db, "select id from sz_recipes");
// $id = $_GET['recipeId'];
// $komment = $_POST['komment'];
$sz_recipes = lekerdezes($db, "select * from sz_recipes");
$hozzavalok = lekerdezes($db, "SELECT sz_ingredients.name FROM sz_recipes_ingredients JOIN sz_ingredients ON sz_recipes_ingredients.ingredientId=sz_ingredients.id");

$category = $_POST['category'];
$description = $_POST['description'];
$name = $_POST['name'];
$vega = $_POST['vega'];
$laktoz = $_POST['laktoz'];
$time = $_POST['time'];
// $image = $_FILES['image']['name'];
$image = $_POST['image'];
$video = $_POST['video'];
$entertainment = NULL;
$slidepic = NULL;
$ingredients = $_POST['ingredients'];


// $target_dir = "media/";
// $target_file = $target_dir . basename($_FILES["image"]["name"]);
// $uploadOk = 1;
// $imageFileType =   strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//     $check = getimagesize($_FILES["image"]["tmp_name"]);
//   if($check !== false) {
//     echo "File is an image - " . $check["mime"] . $_FILES["image"]["tmp_name"] .".";
//     $uploadOk = 1;
//     move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
//     } else {
//     echo "File is not an image.";
//       $uploadOk = 0;
//   }
// }

if (azonositott_e()) {
    //     $felhasznalo = $_SESSION["felhasznalo"];

    $userId = $_SESSION["felhasznalo"]['id'];
    $userName = $_SESSION["felhasznalo"]['username'];
}
//todo1 komment lementése
if ($vega == "igen" && $laktoz == "igen") {
    vegrehajtas(
        $db,
        "INSERT INTO `sz_recipes`(`category`, `description`, `name`, `vega`, `laktoz`, `time`, `image`, `video`, `entertainment`, `slidepic`, `userId`, `userName`) 
                VALUES (:category, :description, :name, :vega, :laktoz, :time, :image, :video, :entertainment, :slidepic, :userId, :userName)",
        ['category' => $category, 'description' => $description, 'name' => $name, 'vega' => 1, 'laktoz' => 1, 'time' => $time, 'image' => $image, 'video' => $video, 'entertainment' => $entertainment, 'slidepic' => $slidepic, 'userId' => $userId, 'userName' => $userName]
    );
    // vegrehajtas($db, "INSERT INTO `sz_ingredients`(`name`, `recipeId`) VALUES (:name, :recipeId)", ['name' => $ingredients, 'recipeId' => $id]);
} else if ($vega == "nem" && $laktoz == 'nem') {
    vegrehajtas(
        $db,
        "INSERT INTO `sz_recipes`(`category`, `description`, `name`, `vega`, `laktoz`, `time`, `image`, `video`, `entertainment`, `slidepic`, `userId`, `userName`) 
                VALUES (:category, :description, :name, :vega, :laktoz, :time, :image, :video, :entertainment, :slidepic, :userId, :userName)",
        ['category' => $category, 'description' => $description, 'name' => $name, 'vega' => 0, 'laktoz' => 0, 'time' => $time, 'image' => $image, 'video' => $video, 'entertainment' => $entertainment, 'slidepic' => $slidepic, 'userId' => $userId, 'userName' => $userName]
    );
    // vegrehajtas($db, "INSERT INTO `sz_ingredients`(`name`, `recipeId`) VALUES (:name, :recipeId)", ['name' => $ingredients, 'recipeId' => $id]);
} else if ($vega == "nem" && $laktoz == 'igen') {
    vegrehajtas(
        $db,
        "INSERT INTO `sz_recipes`(`category`, `description`, `name`, `vega`, `laktoz`, `time`, `image`, `video`, `entertainment`, `slidepic`, `userId`, `userName`) 
                VALUES (:category, :description, :name, :vega, :laktoz, :time, :image, :video, :entertainment, :slidepic, :userId, :userName)",
        ['category' => $category, 'description' => $description, 'name' => $name, 'vega' => 0, 'laktoz' => 1, 'time' => $time, 'image' => $image, 'video' => $video, 'entertainment' => $entertainment, 'slidepic' => $slidepic, 'userId' => $userId, 'userName' => $userName]
    );
    // vegrehajtas($db, "INSERT INTO `sz_ingredients`(`name`, `recipeId`) VALUES (:name, :recipeId)", ['name' => $ingredients, 'recipeId' => $id]);
} else if ($vega == "igen" && $laktoz == 'nem')
    vegrehajtas(
        $db,
        "INSERT INTO `sz_recipes`(`category`, `description`, `name`, `vega`, `laktoz`, `time`, `image`, `video`, `entertainment`, `slidepic`, `userId`, `userName`) 
                VALUES (:category, :description, :name, :vega, :laktoz, :time, :image, :video, :entertainment, :slidepic, :userId, :userName)",
        ['category' => $category, 'description' => $description, 'name' => $name, 'vega' => 1, 'laktoz' => 0, 'time' => $time, 'image' => $image, 'video' => $video, 'entertainment' => $entertainment, 'slidepic' => $slidepic, 'userId' => $userId, 'userName' => $userName]
    );
// vegrehajtas($db, "INSERT INTO `sz_ingredients`(`name`, `recipeId`) VALUES (:name, :recipeId)", ['name' => $ingredients, 'recipeId' => $id]);
//todo2 redirect a receptre
header("Location: index.php");
die();
