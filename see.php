<?php
session_start();//éviter taper le chemin d'accés de la page sur l'URL.
include('inc/header.php');
require_once('config/database.php');
if( isset($_GET['id'])&& !empty($_GET['id']))
    {
        $sql ="SELECT * FROM `users` WHERE `id`=:id ";
        $id=strip_tags($_GET['id']);
        $query = $connection->prepare($sql);
        $query->bindValue(':id',$id,PDO::PARAM_INT);
        $query->execute();
        $personne=$query->fetch();
        if(!$personne){
            header('location:index.php');   
        }
    }
    else{
        header('location:index.php');
    }
    require_once('inc/close.php');
  ?>
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Détails sur <?=$personne['nom']?></h1>
    <p>ID:<?=$personne['id']?></p>
    <p>Nom:<?=$personne['nom']?></p>
    <p>email:<?=$personne['email']?></p>
    <p>website:<?=$personne['website']?></p>
    <td><img src="<?=$personne['image_path']?>" alt="image" class="index-image"></td>
    <p><a href="edite.php?id=<?=$personne['id']?>">Modifier|</a>
        <a href="inc/oublie.php?id=<?=$personne['id']?>">Supprimer</a>
    </p>
    <a href="index.php">Retour</a>
</body>
</html>  