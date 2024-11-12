<?php
try{
    $db_server ="mysql:dbname=personnel;host=localhost";
    $users_name ="root";
    $password="";

    $connection=new PDO($db_server, $users_name,$password);
    $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "connection Error:".$e->getMessage();
}
?>