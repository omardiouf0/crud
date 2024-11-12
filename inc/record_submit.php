<?php
require_once('config/database.php');
$name_error = $email_error = $website_error = "";
$name = $email = $website = $fileToupload = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    try{ 
        // include "inc/user_input.php";
        $file_name = $_FILES["image_path"]["name"];
        $temp_file_name =  $_FILES["image_path"]["tmp_name"];
        $file_size =  $_FILES["image_path"]["size"];
        $dateHeure = date("Y-m-d H-i-s");
        $new_file_name = ( $dateHeure."-".$file_name);
        $target_dir ="uploads/";
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
                            echo"This Extension is not autorise!";
                            $upload_ok = 0;
                        }
                        else{
                            //check if $upload_ok is set to 0 by an error
                            if($upload_ok === 0){
                                echo"file has not been uploaded";
                            }
                            else{
                                if(move_uploaded_file($temp_file_name, $target_file)){
                                    $name=strip_tags($_POST['nom']);
                                    $email=strip_tags($_POST['email']);
                                    $website=strip_tags($_POST['website']);
                                    $db_query ="INSERT INTO users(nom,email,website,image_path) VALUES(:nom,:email,:website,:image_path)";
                                    $statement=$connection-> prepare($db_query);
                                    $statement->bindValue(':nom',$name,PDO::PARAM_STR);
                                    $statement->bindValue(':email',$email,PDO::PARAM_STR);
                                    $statement->bindValue(':website',$website,PDO::PARAM_STR);
                                    $statement->bindValue(':image_path',$target_file,PDO::PARAM_STR);
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
