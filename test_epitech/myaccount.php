<?php
    include 'config.php';
    session_start();
    if (!$_SESSION) {
        header('Location: index.php');
    }
    $id = $_SESSION['id'];
    if ($_POST) {
        
        $sql = "INSERT INTO `library`(`company_name`, `email`, `tel`, `name`, `id_profile`) VALUES (:company_name,:email,:tel,:name, $id )";
        $res = $conn->prepare($sql);
        $exec = $res->execute(array(":company_name"=>$_POST['entreprise'],":email"=>$_POST['email'],":tel"=>$_POST['num'],":name"=>$_POST['nom']));
        // vérifier si la requête d'insertion a réussi
        if($exec){
            header('Location: myaccount.php');
        }else{
            echo "Échec de l'opération d'insertion";
        }
    }
    $sql = "SELECT * FROM `library` where `id_profile` = ".$id;
    try{
        $stmt = $conn->query($sql);
        if($stmt === false){
           die("Erreur");
        }
    }catch (PDOException $e){
        echo $e->getMessage();
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
        <h2>Bonjour <?=$_SESSION['name']?> !</h2>
        <a href="/disconnect.php" class="btn btn-danger" style="position: absolute;top: 10px;right: 10px;">Se déconnecter</a>
        <br>
        <br>
        <h3>Ajouter une carte de visite</h3>
        <br>
        <form method="post" style="text-align: left;width: 70%;">
            <div class="row">
                <div class="col">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom">
                </div>
                <div class="col">
                    <label for="entreprise" class="form-label">Nom de l'entreprise</label>
                    <input type="text" class="form-control" id="entreprise" name="entreprise">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="col">
                    <label for="num" class="form-label">Téléphone</label>
                    <input type="text" class="form-control" id="num" name="num">
                </div>
            </div>
            <br>
            <div class="row justify-content-center">
                <input type="submit" value="Ajouter" class="btn btn-primary col-3">
            </div>
        </form>

        <br>
        <h3>Mes cartes de visites</h3>
        <br>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Nom de l'entreprise</th>
                <th scope="col">Email</th>
                <th scope="col">Téléphone</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                <tr>
                <th scope="row"><?= $row['id'] ?></th>
                <td><?= $row['name']?></td>
                <td><?= $row['company_name']?></td>
                <td><?= $row['email']?></td>
                <td><?= $row['tel']?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
            </table>

        </center>
    </div>
</body>
</html>