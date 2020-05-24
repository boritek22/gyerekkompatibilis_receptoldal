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

        if (isset($_POST['search'])) {
            $valueToSearch = $_POST['valueToSearch'];
            // search in all table columns
            // using concat mysql function
            $query = "SELECT * FROM `users` WHERE CONCAT(`id`, `fname`, `lname`, `age`) LIKE '%" . $valueToSearch . "%'";
            $search_result = filterTable($query);
        } else {
            $query = "SELECT * FROM `users`";
            $search_result = filterTable($query);
        }

        // function to connect and execute the query
        function filterTable($query)
        {
            $connect = mysqli_connect("localhost", "root", "", "test_db");
            $filter_Result = mysqli_query($connect, $query);
            return $filter_Result;
        }

        ?>