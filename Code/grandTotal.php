<?php 
session_start();
echo 'Rp'.number_format($_SESSION['grandTotal']);
?>