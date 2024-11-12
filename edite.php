<?php
session_start();
    include('inc/header.php');
    require_once('config/database.php');
    require_once('inc/recordUpdate.php');

// $id=isset($_GET['id']) ? $_GET['id'] : die ('ERROR Record ID not found.');
if(isset($_GET['id'])){
    $id=$_GET['id'];
}else{
    echo "record Id not found";
}
try{
    $sql="SELECT id,nom,email,website,image_path FROM users WHERE id =:id LIMIT 0,1"; 
       $query=$connection->prepare($sql);
       //on attache les valeurs
       $query->bindParam(':id',$id);
       $query->execute();
       $query->setFetchMode(PDO::FETCH_ASSOC);
       $datas=$query->fetchAll();
    //    header('location:index.php');
}catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
die();
}
?>
<?php 
if(!empty($datas)){
foreach($datas as $data):
    ?>
<div class="form->form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?id={$id}");?>"
            enctype="multipart/form-data">
            <h2>login</h2>
        <br>
        <div>
        <input type="hidden"name="id" value="<?php echo $id;?>">
        </div> 
        <br>  
        <div>
            <label for="nom">Name</label>
            <input type="text"name="nom" value="<?=$data["nom"]?>">
        </div>   
            <br>
            <label for="email">email</label>
            <input type="email"name="email" value="<?=$data["email"]?>">
            <p></p>
            <br>
        <div>
            <label for="website">website</label>
            <input type="text"name="website" value="<?=$data["website"]?>">
            <p></p>
            <br>
        </div>
        <div class="bootom-margin">
            <img src="<?=$data["image_path"]?>" alt="" class="index-image">
            <br>
        <div class="bootom-margin">
            <input type="file"name="fileToUpload"id="fileToUpload">
            <br>
        </div>
        <div>
        <button type="submit" name="update">update</button> 
        </div>
    </form>
</div>
<?php
    endforeach;}
    else{
        echo "$data est vide";
    }
?>

