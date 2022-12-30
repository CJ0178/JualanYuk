<?php 

require 'functions.php';

$userId = $_GET['userId'];
$itemId = $_GET['itemId'];

$query = "
DELETE FROM Owns
WHERE userId = $userId AND itemId = $itemId";

mysqli_query($conn, $query);

?>