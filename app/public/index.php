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

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Guestbook</title>
</head>
<body>
<h1>guestbook</h1>

<div class="container mt-6">
<form method="POST">
    <div class="mb-3 mt-3">
        <label class="form-label">Name: </label>
        <input class="form-control" type="text" name="name" />
    </div>
    <div class="mb-3">
        <label class="form-label">Message: </label>
        <textarea class="form-control" name="message"></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Email: </label>
        <textarea class="form-control" name="email"></textarea>
    </div>
    <div class="form-field">
        <label class="form-label">&nbsp;</label>
        <input class="btn btn-primary" type="submit" value="Send"  />
        
    </div>
</form>
</div>

<div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>post Details
                        
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Posted at</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Ip address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                    $query = "SELECT * FROM posts";
                                    $query_run = $connection->query($sql);

                                   foreach($query_run as $post)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $post['id']; ?></td>
                                                <td><?= $post['posted_at']; ?></td>
                                                <td><?= $post['name']; ?></td>
                                                <td><?= $post['email']; ?></td>
                                                <td><?= $post['message']; ?></td>
                                                <td><?= $post['ip_address']; ?></td>
                                                <td>
                                                    <a href="post-edit.php?id=<?= $post['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                                    <form action="delete.php" method="POST" class="d-inline">
                                                        <button type="submit" name="delete_post" value="<?=$post['id'];?>" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    
                                    
                                ?>
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


 <?php

if(isset($_POST["name"])){
    $stmt = $connection->prepare("INSERT INTO posts
                                    (name,message,email,posted_at, ip_address)
                                    VALUES
                                    (:name, :message,:email,now(), :ip_address)");

    echo "<meta http-equiv='refresh' content='0'>";
    $name = $_POST['name'];
    $message = $_POST['message'];
    $email = $_POST['email'];

    $stmt -> bindParam(':name',$name);
    $stmt -> bindParam(':message',$message);
    $stmt -> bindParam(':email',$email);
    $stmt -> bindParam(':ip_address',$_SERVER['REMOTE_ADDR']);
    $stmt -> execute();
    
}
?>






  

</body>
</html>