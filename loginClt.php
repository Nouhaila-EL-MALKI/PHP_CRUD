<?php
session_start();
include "ConnBD.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $login = $_POST['login'];
    $pwd = $_POST['password'];

    $query = "SELECT * FROM client WHERE login = ? and  motPasse = ?";

    $stmt = $pdo ->prepare($query);
    $stmt ->execute([$login, $pwd]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['idClient'] = $row['id_client'];
    if($row){
        if($pwd == $row["motPasse"]){
            header("Location: menu.php?firstname={$row['prenom']}&lastname={$row['nomClient']}");
        }else{
            echo "<script>alert('the password is wrong');</script>";
        }
    }else{
        echo "<script>alert('the login does not existe');</script>";
    }
    
    
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Client</title>
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
        .form-group input {
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
        }
        .btn:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Connexion Client</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="login">Nom d'utilisateur :</label>
                <input type="text" id="login" name="login" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn">Se connecter</button>
            </div>
        </form>
    </div>
</body>
</html>
