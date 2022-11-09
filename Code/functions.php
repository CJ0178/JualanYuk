<?php 
// Connect Database
$conn = mysqli_connect("localhost", "root", "", "jualanyuk");

// Function query return array associative
function query($strQuery){
    global $conn;

    // Ambil hasil select dari query
    $result = mysqli_query($conn, $strQuery);

    // Convert ke array associative
    $temp = [];

    while($row = mysqli_fetch_assoc($result)){
        $temp[] = $row;
    }

    return $temp;
}


?>