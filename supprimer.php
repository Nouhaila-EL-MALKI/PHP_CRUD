<?php 
include "ConnBD.php";
$idReserv = $_GET['id'];
$query = "DELETE FROM reservation WHERE idReserv = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$idReserv]);
header("Location: afficherReservation.php");
?>