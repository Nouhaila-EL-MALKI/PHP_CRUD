<?php
include "ConnBD.php";
session_start();
$id_client = $_SESSION['idClient'];
$query = "SELECT * FROM reservation inner join client on reservation.idClient = client.id_client WHERE idClient = ? ";
$stmt = $pdo->prepare($query);
$stmt->execute([$id_client]);
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

include "menu.php";
?>
    <div class="container mt-5">
        <h1>Liste des Réservations</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Nombre de Personne</th>
                    <th scope="col">Date Promonade</th>
                    <th scope="col">Heure Promonade</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($reservations as $reservation):?>
                    <tr>
                        <td><?php echo $reservation['nomClient']?></td>
                        <td><?php echo $reservation['prenom']?></td>
                        <td><?php echo $reservation['nbrPers']?></td>
                        <td><?php echo $reservation['datePromonade']?></td>
                        <td><?php echo $reservation['heurePromonade']?></td>
                        <td>
                            <button class="btn btn-danger"><a class="text-white text-decoration-none" href="supprimer.php?id=<?php echo $reservation['idReserv']; ?>">Supprimer</a></button>
                            <button class="btn btn-success"><a class="text-white text-decoration-none" href="editer.php?id=<?php echo $reservation['idReserv']; ?>">Editer</a></button>
                        </td>
                    </tr>
                <?php endforeach;?>

    </body>
</html>
