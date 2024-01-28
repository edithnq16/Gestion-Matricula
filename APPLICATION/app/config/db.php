<?php
try{
$conn = new PDO('mysql:host=localhost; dbname=colegio', 'root', '');
} catch(PDOException $e){
   echo "Error: ". $e->getMessage();
   die();
}
?>