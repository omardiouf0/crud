<?php
session_start();
//on inclut la connexin à la base
require_once ('../config/database.php');
require_once('header.php');
if(isset($_GET['id'])&&!empty($_GET['id'])){
    $id=strip_tags($_GET['id']);
    $sql= "SELECT * FROM `users` WHERE `id`=:id";
    //on prépare la requête
    $query=$connection->prepare($sql);
    //on attache les valeurs
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    //on execute la requête
    $query->execute();
    $info=$query->fetch();
}
?>
<?php
 if(isset($_POST['id'])&&!empty($_POST['id'])&&
 isset($_POST['nom'])&&!empty($_POST['nom'])
 &&isset($_POST['email'])&&!empty($_POST['email'])
 &&isset($_POST['website'])&&!empty($_POST['website'])){
     $id=strip_tags($_POST['id']);
     $nom=strip_tags($_POST['nom']);
     $email=strip_tags($_POST['email']);
     $website=strip_tags($_POST['website']);
     $sql="UPDATE `users` SET `nom`= :nom,
      `email`=:email,`website`=:website WHERE `id` =:id ";
      $query=$connection->prepare($sql);
      //on attache les valeurs
      $query->bindValue(':id',$id,PDO::PARAM_INT);
      $query->bindValue(':nom',$nom,PDO::PARAM_STR);
      $query->bindValue(':email',$email,PDO::PARAM_STR);
      $query->bindValue(':website',$website,PDO::PARAM_STR);
      //on execute la requête
      $query->execute();
      header('location:../index.php');
      exit();
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <form method="post" action="">
            <input type="hidden" name="id"value="<?=$info["id"]?>"> 
        <p>
            <label for="nom">Nom</label>
            <input type="text"name="nom"value="<?=$info["nom"]?>">
        </p>
        <p>
            <label for="email">Email</label>
            <input type="email"name="email"value="<?=$info["email"]?>">
        </p>
        <p>
            <label for="website">Website</label>
            <input type="text"name="website"value="<?=$info["website"]?>">
        </p>
        <button>Modifier</button>
    </form>
</body>
</html>
