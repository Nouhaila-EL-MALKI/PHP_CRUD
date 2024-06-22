
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Menu de Navigation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        nav {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            display: block;
        }
        .menu-right {
            display: flex;
            align-items: center;
        }
        .menu-right a {
            color: #fff;
            text-decoration: none;
            margin-left: 20px;
        }
        .menu-bottom {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: #fff;
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">Promenade</div>
        <div class="menu-right">
            <a href="AjouterR.php">Ajouter réservation</a>
            <a href="afficherReservation.php">Afficher réservation</a>
            <a href="deconnection.php">Déconnexion</a>
        </div>
    </nav>
    <?php
    $firstName = isset($_GET['firstname']) ? $_GET['firstname'] : '';
    $lastName = isset($_GET['lastname']) ? $_GET['lastname'] : '';
    ?>
        <h1> welcome <?= $firstName . "  " . $lastName ?> </h1>
