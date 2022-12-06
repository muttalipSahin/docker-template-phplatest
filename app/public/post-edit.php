<?php
    include('dbconfig.php');

    try {
        $connection = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "Connection failed: ". $e->getMessage();
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>PHP PDO using bindParam() function CRUD</title>
</head>
<body>
    
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h4> Edit 
                            <a href="index.php" class="btn btn-primary float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if(isset($_GET['id']))
                        {
                            $id = $_GET['id'];

                            $query = "SELECT * FROM posts WHERE id=? LIMIT 1";
                            $statement = $connection->prepare($query);
                            $statement->bindParam(1, $id, PDO::PARAM_INT);
                            $statement->execute();

                            $data = $statement->fetch(PDO::FETCH_ASSOC);
                            ?>
                            
                            <form action="code.php" method="POST">

                                <input type="hidden" name="id" value="<?=$data['id'];?>">

                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name" value="<?=$data['name'];?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Message</label>
                                    <input type="text" name="message" value="<?=$data['message'];?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" value="<?=$data['email'];?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="update_post" class="btn btn-primary">Update post</button>
                                </div>
                            </form>
                            
                            <?php
                        }
                        else
                        {
                            echo "<h5>No ID Found</h5>";
                        }
                        
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>