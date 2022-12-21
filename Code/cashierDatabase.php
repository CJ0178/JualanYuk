<?php 

session_start();
require 'functions.php';

// Ketika pencet upload pesanan,
// - Delete dari Cashier
// - Modify/Delete owns
// - Insert Sell

// Modify/Delete Owns
$query = "
UPDATE Owns o
JOIN Cashier c ON c.userId = o.userId AND c.itemId = o.itemId
SET o.qty = o.qty - c.qty
";

mysqli_query($conn, $query);

// Insert Sell
$query = "
INSERT INTO Sell
SELECT
NULL AS 'SellId',
c.userId,
c.itemId,
DATE(CURRENT_TIMESTAMP),
c.qty,
o.COGS,
o.sellPrice
FROM Cashier c
JOIN owns o ON o.itemId = c.itemId AND o.userId = c.userId
";

mysqli_query($conn, $query);

// Delete dari kasir
$query = "DELETE FROM Cashier";
mysqli_query($conn, $query);

redirectTo('kasir/kasir.php')
?>