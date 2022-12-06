<?php
require("dbconfig.php");

try {
    $connection = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Connection failed: ". $e->getMessage();
}

if(isset($_POST['update_post']))
{
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    try {

        $query = "UPDATE posts SET name=:name, email=:email, message=:message WHERE id=:id";
        $statement = $connection->prepare($query);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':message', $message);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $query_execute = $statement->execute();

        if($query_execute)
        {
            $_SESSION['message'] = "Updated Successfully";
            header('Location: index.php');
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not Updated";
            header('Location: index.php');
            exit(0);
        }

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
}

?>