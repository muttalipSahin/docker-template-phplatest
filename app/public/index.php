
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Guestbook</title>

    <?php
    require_once("dbconfig.php");
    try {
        $connection = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "Connection failed: ". $e->getMessage();
    }
    $sql = "SELECT * FROM posts";
    $result = $connection->query($sql);
?>
</head>
<body>
<?php
    foreach ($result as $row){
        ?>
        <div id = "data">
            <h1 class = "header"><?php echo "<br>"."".$row['name'];?></h1>
            <?php echo "<br>"."".$row['message'];
                  echo "<br>".$row['posted_at'];?>
        </div>
     <?php
}

?>
</body>
</html>
