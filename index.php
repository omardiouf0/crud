<?php
    include('inc/header.php');
    require_once ('config/database.php');
    $sql='SELECT * FROM users ORDER BY id ASC';
    $query=$connection->prepare($sql);
    $query->execute();
    $query->setFetchMode(PDO::FETCH_ASSOC);
       $datas=$query->fetchAll();
    //on stocke le résultat dans un tableau associatif
   

    require_once('inc/close.php');
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des personnages</title>
    <!-- <link rel="stylesheet" href="css/decore.css"> -->
</head>
<body>
    <h1>Liste des personnages</h1>
    <a href="create.php">Ajoutez des personnages <br></a>
    <table>
        <thead>
            <th>Id</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Website</th>
            <th>File</th>
            <th>Voir</th>
            <th>Edit</th>
            <th>Supprimer</th>
        </thead>
        <tbody>
            <?php
            foreach($datas as $personne){
            ?>
                <tr>
                    <td><?=$personne['id']?></td>
                    <td><?=$personne['nom']?></td>
                    <td><?=$personne['email']?></td>
                    <td><?=$personne['website']?></td>
                    <td><img src="<?=$personne['image_path']?>" alt="image" class="index-image"></td>
                    <td><a href="see.php?id=<?=$personne['id']?>">Voir</a></td>
                    <td><a href="edite.php?id=<?=$personne['id']?>">Modifier</a></td>
                    <td><a href="inc/oublie.php?id=<?=$personne['id']?>">Supprimer</a></td>
                </tr>
            <?php
            }
            ?>
            
        </tbody>

    </table>
</body>
</html>