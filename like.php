<?php
session_start();

include("auth.php");
include("database.php");

if (isset($_GET['type'], $_GET['id'])){

    $type = $_GET['type'];
    $id = (int)$_GET['id'];

    switch($type){
        case 'sz_recipes':
            echo 'OK!';

            //     case 'sz_recipes':
            // lekerdezes($db -> query("INSERT INTO 
            // likes (userId, recipeId) 
            // SELECT {$_SESSION['user_id']}, {$id} 
            // FROM sz_recipes 
            // WHERE EXISTS (SELECT id FROM sz_recipes 
            // WHERE id = {$id}) AND NOT EXISTS (SELECT id 
            // FROM likes WHERE user = {$_SESSION['user_id']} 
            // AND recipeId = {$id}) LIMIT 1"));
            break;
    }
}