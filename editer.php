<?php

include "ConnBD.php";
session_start();

//charger les données dans le formulaire
// RESERVATIO
$idReserv = isset($_GET['id']) ? $_GET['id'] : "";
$query = "SELECT * from reservation where idReserv = ?";
$stmtR = $pdo->prepare($query);
$stmtR->execute([$idReserv]);
$reservation = $stmtR->fetch(PDO::FETCH_ASSOC);

//CLIENT
$idClient = isset($_SESSION['idClient']) ? $_SESSION['idClient'] : "";
$query = "SELECT * from client where id_client = ?";
$stmtC = $pdo->prepare($query);
$stmtC->execute([$idClient]);
$clients = $stmtC->fetch(PDO::FETCH_ASSOC);

// récupérer le id de l'utilisateur connecté 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = isset($_POST['nom']) ? $_POST['nom'] : "";
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
    

    // Update client information
    $queryClient = "UPDATE client SET nomClient = ?, prenom = ? WHERE id_client = ?";
    $stmtClient = $pdo->prepare($queryClient);
    $stmtClient->execute([$nom, $prenom, $idClient]);

    $nbrPers = isset($_POST['nbrPers']) ? $_POST['nbrPers'] : "";
    $datePromo = isset($_POST['datePromonade']) ? date('Y-m-d', strtotime($_POST['datePromonade'])) : "";
    $heurePromo = isset($_POST['heurePromonade']) ? $_POST['heurePromonade'] : "";

    // Update reservation information
    $queryReserv = "UPDATE reservation SET nbrPers = ?, datePromonade = ?, heurePromonade = ? WHERE idReserv = ?";
    $stmtReserv = $pdo->prepare($queryReserv);
    $stmtReserv->execute([$nbrPers, $datePromo, $heurePromo, $idReserv]);

    if ($stmtReserv->rowCount() > 0 || $stmtClient->rowCount() > 0) {
        header('Location: afficherReservation.php');
    }



}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editer Reservation</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Editer Reservation</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" value="<?=$clients['nomClient']?>" name="nom" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prenom</label>
            <input type="text" class="form-control" value="<?=$clients['prenom']?>"  name="prenom" required>
        </div>
        <div class="form-group">
            <label for="nbrPers">Nombre de Personne</label>
            <input type="number" class="form-control" value="<?=$reservation['nbrPers']?>" name="nbrPers" required>
        </div>
        <div class="form-group">
            <label for="datePromo">Date Promonade</label>
            <input type="date" class="form-control" value="<?=$reservation['datePromonade']?>" name="datePromonade" required>
        </div>
        <div class="form-group">
            <label for="heure">Heure Promonade</label>
            <input type="time" class="form-control" value="<?=$reservation['heurePromonade']?>" name="heurePromonade" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Reservation</button>
    </form>
</div>
</body>
</html>
