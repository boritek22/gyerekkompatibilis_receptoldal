<?php

include("auth.php");
include("database.php");

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `sz_recipes` WHERE CONCAT(`id`, `category`, `description`, `name`, `vega`, `laktoz`, `time`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `sz_recipes`";
    $search_result = filterTable($query);
}

// function to connect and execute the query
// function filterTable($query)
// {
//     $connect = mysqli_connect("localhost", "root", "", "test_db");
//     $filter_Result = mysqli_query($connect, $query);
//     return $filter_Result;
// }

// ?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
  <title>Főoldal</title>
  <link rel="icon" href="media/logo9.png">
  <link href="css/main.css" rel="stylesheet" type="text/css" title="alap">
  <script src="js/menu.js"></script>
  
        <title>PHP HTML TABLE DATA SEARCH</title>
        <style>
            table,tr,th,td
            {
                border: 1px solid black;
            }
        </style>

    </head>
    <body>
        
        <form action="index.php" method="post">
            <input type="text" name="search" placeholder="Value To Search"><br><br>
            <input type="submit" name="search" value="Filter"><br><br>
            
            <table>
                <tr>
                    <th>Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                </tr>

      <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['category'];?></td>
                    <td><?php echo $row['description'];?></td>
                </tr>
                <?php endwhile;?>
            </table>
        </form>
        
    </body>
</html>