<?php 

require 'functions.php';

$userId = $_GET['userId'];
$itemId = $_GET['itemId'];

$query = "
DELETE FROM owns
WHERE userId = $userId AND itemId = $itemId";

mysqli_query($conn, $query);

?>