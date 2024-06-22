<?php
session_start();
include "ConnBD.php";
include "menu.php";
$query = "SELECT nomTrajet,idTrajet FROM trajet";
$stmt = $pdo->prepare($query);
$stmt->execute();
//les trajets dans le menu déroulant
$tarjets = $stmt->fetchAll(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $Trajetselectione = $_POST['trajet'];
    $dateProm = $_POST['date'];
    $heurProm = $_POST['time'];
    $nbrPrers = $_POST['number'];
    $clientId = isset($_SESSION['idClient']) ? $_SESSION['idClient']  : '';

    $query = "SELECT idPromenade FROM promenade WHERE idTrajet = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$Trajetselectione]);
    $idPromenade = $stmt->fetchColumn();


    $query = "INSERT INTO reservation (idClient, idPromonade, nbrPers, datePromonade, heurePromonade) VALUES(?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$clientId, $idPromenade, $nbrPrers, $dateProm, $heurProm]);
    if($stmt){
        echo "<script>alert('Done')</script>";
    }else{
        echo "<script>alert('Error')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Réservation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            width: 100%;
        }
        .btn:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ajouter Réservation</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="trajet">Nom de trajet :</label>
                <select id="trajet" name="trajet" required>
                    <?php foreach($tarjets as $trajet): ?>
                        <option value="<?= $trajet['idTrajet']?>"><?= $trajet['nomTrajet']?></option>
                        <?php endforeach;?>
                </select>
            </div>
            <div class="form-group">
                <label for="date">Date de promenade :</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="time">Heure de promenade :</label>
                <input type="time" id="time" name="time" required>
            </div>
            <div class="form-group">
                <label for="number">Nombre de personnes :</label>
                <input type="number" id="number" name="number" required min="1">
            </div>
            <div class="form-group">
                <button type="submit" class="btn">Valider la réservation</button>
            </div>
        </form>
    </div>
</body>
</html>
