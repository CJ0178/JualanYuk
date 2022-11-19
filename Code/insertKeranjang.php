<?php 
if(isset($_GET['userId'])&&
    isset($_GET['itemId'])
){
    $userId = $_GET['userId'];
    $itemId = $_GET['itemId'];

    echo "INSERT INTO trolly VALUES($userId, $itemId, $";
} else{
    redirectTo('home/home.php');
}

?>