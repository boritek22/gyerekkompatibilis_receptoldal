<?php
session_start();

include("auth.php");
include("database.php");

$sz_recipes = lekerdezes($db, "select * from sz_recipes");
$hozzavalok = lekerdezes(
    $db,
    "SELECT I.name, I.amount, A.mertekegyseg
    FROM sz_recipes R
    JOIN sz_ingredients I ON I.recipeId = R.id
    JOIN sz_amounts A ON I.amountId = A.id"
);


$category = $_POST['category'];
$description = $_POST['description'];
$name = $_POST['name'];
$vega = $_POST['vega'];
$laktoz = $_POST['laktoz'];
$time = $_POST['time'];
$image = $_FILES['image']['name'];
$video = $_POST['video'];
$entertainment = $_POST['entertainment'];
$entertainment2 = $_POST['entertainment2'];

$amounts = $_POST['amounts'];
$mertekek = $_POST['mertekek'];
$ingredients = $_POST['ingredients'];

$array = [];
$sz_amounts = lekerdezes($db, "select * from sz_amounts");
foreach ($sz_amounts as $sz_amount) {
    array_push($array, $sz_amount['mertekegyseg']);
}

$id = count(lekerdezes($db, "select * from sz_recipes")) + 1;

if (azonositott_e()) {
    $userId = $_SESSION["felhasznalo"]['id'];
    $userName = $_SESSION["felhasznalo"]['username'];
}

$target_dir = "media/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType =   strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . $_FILES["image"]["tmp_name"] . ".";
        $uploadOk = 1;
        // move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";

    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
    }
}


if ($vega == "igen" && $laktoz == "igen") {
    vegrehajtas(
        $db,
        "INSERT INTO `sz_recipes`(`category`, `description`, `name`, `vega`, `laktoz`, `time`, `image`, `video`, `entertainment`, `entertainment2`, `userId`, `userName`) 
                VALUES (:category, :description, :name, :vega, :laktoz, :time, :image, :video, :entertainment, :entertainment2, :userId, :userName)",
        ['category' => $category, 'description' => $description, 'name' => $name, 'vega' => 1, 'laktoz' => 1, 'time' => $time, 'image' => $image, 'video' => $video, 'entertainment' => $entertainment, 'entertainment2' => $entertainment2, 'userId' => $userId, 'userName' => $userName]
    );
    $id = $db->lastInsertId();
    foreach ($amounts as $key => $amount) {
        if (in_array($mertekek[$key], $array)) {
            $mertekId = $sz_amounts[array_search($mertekek[$key], $array)]['id'];
        } else {
            vegrehajtas($db, "INSERT INTO `sz_amounts`(`mertekegyseg`) VALUES (:mertekegyseg)", ['mertekegyseg' => $mertekek[$key]]);
            $array[] = $mertekek[$key];
            $mertekId = $db->lastInsertId();
            $temparray = [];
            $temparray['id'] = $mertekId;
            $sz_amounts[] = $temparray;
        }
        vegrehajtas($db, "INSERT INTO `sz_ingredients`(`name`, `recipeId`, `amount`, `amountId`) VALUES (:name, :recipeId, :amount, :amountId)", ['name' => $ingredients[$key], 'recipeId' => $id, 'amount' => $amount, 'amountId' => $mertekId]);
    }
} else if ($vega == "nem" && $laktoz == 'nem') {
    vegrehajtas(
        $db,
        "INSERT INTO `sz_recipes`(`category`, `description`, `name`, `vega`, `laktoz`, `time`, `image`, `video`, `entertainment`,  `entertainment2`, `userId`, `userName`) 
                VALUES (:category, :description, :name, :vega, :laktoz, :time, :image, :video, :entertainment, :entertainment2, :userId, :userName)",
        ['category' => $category, 'description' => $description, 'name' => $name, 'vega' => 0, 'laktoz' => 0, 'time' => $time, 'image' => $image, 'video' => $video, 'entertainment' => $entertainment, 'entertainment2' => $entertainment2, 'userId' => $userId, 'userName' => $userName]
    );
    $id = $db->lastInsertId();
    foreach ($amounts as $key => $amount) {
        if (in_array($mertekek[$key], $array)) {
            $mertekId = $sz_amounts[array_search($mertekek[$key], $array)]['id'];
        } else {
            vegrehajtas($db, "INSERT INTO `sz_amounts`(`mertekegyseg`) VALUES (:mertekegyseg)", ['mertekegyseg' => $mertekek[$key]]);
            $array[] = $mertekek[$key];
            $mertekId = $db->lastInsertId();
            $temparray = [];
            $temparray['id'] = $mertekId;
            $sz_amounts[] = $temparray;
        }
        vegrehajtas($db, "INSERT INTO `sz_ingredients`(`name`, `recipeId`, `amount`, `amountId`) VALUES (:name, :recipeId, :amount, :amountId)", ['name' => $ingredients[$key], 'recipeId' => $id, 'amount' => $amount, 'amountId' => $mertekId]);
    }
} else if ($vega == "nem" && $laktoz == 'igen') {
    vegrehajtas(
        $db,
        "INSERT INTO `sz_recipes`(`category`, `description`, `name`, `vega`, `laktoz`, `time`, `image`, `video`, `entertainment`, `entertainment2`, `userId`, `userName`) 
                VALUES (:category, :description, :name, :vega, :laktoz, :time, :image, :video, :entertainment, :entertainment2, :userId, :userName)",
        ['category' => $category, 'description' => $description, 'name' => $name, 'vega' => 0, 'laktoz' => 1, 'time' => $time, 'image' => $image, 'video' => $video, 'entertainment' => $entertainment, 'entertainment2' => $entertainment2, 'userId' => $userId, 'userName' => $userName]
    );
    $id = $db->lastInsertId();
    foreach ($amounts as $key => $amount) {
        if (in_array($mertekek[$key], $array)) {
            $mertekId = $sz_amounts[array_search($mertekek[$key], $array)]['id'];
        } else {
            vegrehajtas($db, "INSERT INTO `sz_amounts`(`mertekegyseg`) VALUES (:mertekegyseg)", ['mertekegyseg' => $mertekek[$key]]);
            $array[] = $mertekek[$key];
            $mertekId = $db->lastInsertId();
            $temparray = [];
            $temparray['id'] = $mertekId;
            $sz_amounts[] = $temparray;
        }
        vegrehajtas($db, "INSERT INTO `sz_ingredients`(`name`, `recipeId`, `amount`, `amountId`) VALUES (:name, :recipeId, :amount, :amountId)", ['name' => $ingredients[$key], 'recipeId' => $id, 'amount' => $amount, 'amountId' => $mertekId]);
    }
} else if ($vega == "igen" && $laktoz == 'nem') {
    vegrehajtas(
        $db,
        "INSERT INTO `sz_recipes`(`category`, `description`, `name`, `vega`, `laktoz`, `time`, `image`, `video`, `entertainment`, `entertainment2`, `userId`, `userName`) 
                VALUES (:category, :description, :name, :vega, :laktoz, :time, :image, :video, :entertainment, :entertainment2, :userId, :userName)",
        ['category' => $category, 'description' => $description, 'name' => $name, 'vega' => 1, 'laktoz' => 0, 'time' => $time, 'image' => $image, 'video' => $video, 'entertainment' => $entertainment, 'entertainment2' => $entertainment2, 'userId' => $userId, 'userName' => $userName]
    );
}
$id = $db->lastInsertId();
foreach ($amounts as $key => $amount) {
    if (in_array($mertekek[$key], $array)) {
        $mertekId = $sz_amounts[array_search($mertekek[$key], $array)]['id'];
    } else {
        vegrehajtas($db, "INSERT INTO `sz_amounts`(`mertekegyseg`) VALUES (:mertekegyseg)", ['mertekegyseg' => $mertekek[$key]]);
        $array[] = $mertekek[$key];
        $mertekId = $db->lastInsertId();
        $temparray = [];
        $temparray['id'] = $mertekId;
        $sz_amounts[] = $temparray;
    }
    vegrehajtas($db, "INSERT INTO `sz_ingredients`(`name`, `recipeId`, `amount`, `amountId`) VALUES (:name, :recipeId, :amount, :amountId)", ['name' => $ingredients[$key], 'recipeId' => $id, 'amount' => $amount, 'amountId' => $mertekId]);
}
//redirect a receptre
// header("Location: index.php");
// die();
