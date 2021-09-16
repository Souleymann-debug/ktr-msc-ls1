<?php
    include 'config.php';

    if ($_POST) {
        $query = $conn->prepare("SELECT * FROM profile WHERE email = ?");
        $query->execute([$_POST['email']]);
        $user = $query->fetch();
        if ($user && password_verify($_POST['password'], $user['password'])){
            session_start();
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['entreprise'] = $user['company_name'];
            $_SESSION['tel'] = $user['tel'];
            header('Location: myaccount.php');
        } else {
            echo '<script>alert("Compte inexistant !")</script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TestEpitech | Page de connexion</title>
    </head>
    <body>
        <div class="container">
            <br>
            <center>
            <h2>Votre site d'enregistrement de cartes de visites</h2>
            <br>
            <form action="" method="post">
            <div style="width: 30%;text-align: left;" >
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Votre mot de passe">
                </div>
            </div>
            <br>
            <input type="submit" value="Se connecter" class="btn btn-primary">
            <br>
            <br>
            <a href="/register.php">Vous n'avez pas de compte ? Inscrivez vous !</a>
            </form>
            </center>
        </div>
    </body>
</html>