<?php
    include 'config.php';
    if ($_POST) {
        if ($_POST['pass']==$_POST['pass2']) {
            $sql = "INSERT INTO `profile`(`company_name`, `email`, `password`, `tel`, `name`) VALUES (:company_name,:email,:password,:tel,:name)";
            $res = $conn->prepare($sql);
            $exec = $res->execute(array(":company_name"=>$_POST['entreprise'],":email"=>$_POST['email'],":password"=>password_hash($_POST['pass'],PASSWORD_DEFAULT),":tel"=>$_POST['num'],":name"=>$_POST['nom']));
            // vérifier si la requête d'insertion a réussi
            if($exec){
                echo '<script>alert("Vous allez etre redirigé vers la page de connexion")</script>';
                header('Location: index.php');
            }else{
                echo "Échec de l'opération d'insertion";
            }
        }
        else{
            echo '<script>alert("Les mots de passes ne correspondent pas !")</script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TestEpitech | Page d'inscription</title>
</head>
<body>
<div class="container">
            <br>
            <center>
            <h2>Inscrivez vous en 2 minutes !</h2>
            <br>
            <form action="" method="post">
            <div style="width: 70%;text-align: left;" >
                <div class="row justify-content-center">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="pass" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="pass" name="pass">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="entreprise" class="form-label">Votre entreprise</label>
                            <input type="text" class="form-control" id="entreprise" name="entreprise">
                        </div>

                        <div class="mb-3">
                            <label for="num" class="form-label">Numéro de téléphone</label>
                            <input type="text" class="form-control" id="num" name="num">
                        </div>
                        <div class="mb-3">
                            <label for="pass2" class="form-label">Confirmation du mot de passe</label>
                            <input type="password" class="form-control" id="pass2" name="pass2">
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <input type="submit" value="S'inscrire" class="btn btn-primary">
            </form>
            </center>
        </div>
</body>
</html>