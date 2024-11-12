<?php
 require_once('config/database.php');
 if(isset($_POST['update'])){
    try{
        function user_input($data){
            $data1 =trim($data);// éliminer les sespaces
            $data2 = stripslashes($data1); // éliminer les caractéres spéciaux
            $data3 = htmlspecialchars($data2); // éviter l'interpretations du code html
            return $data3;
        }
        $id = $_POST['id'];
        $nom = user_input($_POST["nom"]);
        $email = user_input($_POST["email"]);
        $website = user_input($_POST["website"]);
        $file_name = $_FILES["fileToUpload"]["name"];
        $temp_file_name =  $_FILES["fileToUpload"]["tmp_name"];
        $file_size =  $_FILES["fileToUpload"]["size"];
        $target_dir ="uploads/";
        $dateHeure = date("Y-m-d H-i-s");
        $new_file_name = ( $dateHeure."-".$file_name);
        $target_file = strtolower($target_dir. basename($new_file_name));
        $upload_ok = 1;
        $img_file_type = pathinfo($target_file,PATHINFO_EXTENSION);
        //check if images is an actuel image or take image 
        if(!empty($temp_file_name) && file_exists($temp_file_name)){
                $check_img = getimagesize($temp_file_name);
            if($check_img === false){
                echo"File is not an image";
                $upload_ok =0;
            }else{
                // $upload_ok = 1;
                //check if file already exists 
                if(file_exists($target_file))
                    {
                        echo "l'image est déja existé";
                        $upload_ok = 0;
                    }
                else{
                    // check file size 
                    if($file_size>500000){
                        echo"Please enter a file size between 5mo";
                        $upload_ok = 0;
                    }
                    else{
                        //Allow certain file formats
                        if($img_file_type !="jpeg"&& $img_file_type !="gif" && $img_file_type !="png" &&$img_file_type !="jpg"){
                            echo"This Extension is not autorise,JPEG,PNG,JPG and GIF files are autoeise!";
                            $upload_ok = 0;
                        }
                        else{
                            //check if $upload_ok is set to 0 by an error
                            if($upload_ok === 0){
                                echo"file has not been uploaded";
                            }
                            else{
                                if(move_uploaded_file($temp_file_name, $target_file))
                                {
                                    $db_query ="UPDATE users SET id=:id,nom=:nom,email=:email,website=:website,
                                    image_path=:image_path WHERE id=:id";
                                    $statement=$connection-> prepare($db_query);
                                    $statement->bindParam(':nom',$nom,PDO::PARAM_STR);
                                    $statement->bindParam(':email',$email,PDO::PARAM_STR);
                                    $statement->bindParam(':website',$website,PDO::PARAM_STR);
                                    $statement->bindParam(':image_path',$target_file,PDO::PARAM_STR);
                                    $statement->bindParam(':id',$id,PDO::PARAM_INT);
                                    $statement->execute();
                                    header('location:index.php');
                                    
                                }
                            }
                        }
                    }
                }
            }
        }else{
            echo"le fichier n'est pas été téléchargé";
        }  
    }
    catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    } 
}
