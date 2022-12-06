<?php

require("dbconfig.php");

try {
    $connection = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Connection failed: ". $e->getMessage();
}

$sql = "SELECT * FROM posts";
$result = $connection->query($sql);

if(isset($_POST['delete_post'])){
    $id = $_POST['delete_post'];
    $query = "DELETE FROM posts WHERE id = $id";
    $result = $connection->query($query);
    header("Location: index.php");
    exit (0);
}

?>