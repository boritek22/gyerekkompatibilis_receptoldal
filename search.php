<?php

include("auth.php");
include("database.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>search page</h1>

    <div>
        <?php
        if (isset($_POST['submit-search'])) {
            $search = mysqli_real_escape_string($db, $_POST['search']);
            $sql = "SELECT * FROM sz_recipes WHERE name LIKE '%$search%' OR description LIKE '%$search%'";
            $result = mysqli_query($db, $sql);
            $queryResults = mysqly_num_rows($result);
        }
        ?>

        <div>

            <?php if (count($queryResults) === 0) { ?>
                <h4>Nincs találat</h4>
            <?php } else { ?>
                <h4>Van találat</h4>
            <?php } ?>
        </div>

    </div>

</body>

</html>