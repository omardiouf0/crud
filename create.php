<?php require('inc/header.php');?> 
<div class="bottom-margin">
    <a href="index.php"><button>Back to record</button></a>
</div>
<div class="form-data">
     <?php
        include('inc/record_submit.php');
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            if(empty($_REQUEST["nom"]) || empty($_REQUEST["email"]) || empty($_REQUEST["website"])||empty($_REQUEST["image_path"])) 
             {
                echo"<p class='error'>Il faut remplire tout les champs</p>";
            }
            else{
                echo"<p class='success'>Les informations sont enregistrées avec succés</p>";
            }
        }
    ?> 
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
        enctype="multipart/form-data">
        <h2>login</h2>
    <br>
    <div>
        <label for="nom">Name</label>
        <input type="text"name="nom" id="nom">
    </div>   
        <br>
        <label for="email">email</label>
        <input type="email"name="email" id="email">
        <p></p>
        <br>
    <div>
        <label for="website">website</label>
        <input type="text"name="website" id="website">
        <p></p>
        <br>
    </div>
    <div>
        <label for="image_path">FileToUploads</label>
        <input type="file"name="image_path" id="image_path">
        <p></p>
        <br>
    </div>
    <div> 
        <button type="submit" name ="submit">submit</button>
    </div> 
    </div>
</form>
<?php include('inc/footer.php');?>



