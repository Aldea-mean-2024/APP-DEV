<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
</head>
<style>
table, th, td {
  border:1px solid pink;
}
</style>
<body>
    <h1>PRODUCTS</h1>
    <table style="width: 50%;">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Created_AT</th>
                <th>Updated_AT</th>
                <th>Action</th>
            </tr>
            <tr>
                <a href="create.php" role="button"> click here  </a>
            </tr>
        </thead>
        <tbody>
        <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "mean_mean";
                    

                    //create connection
                    $connection = new mysqli($servername,$username,$password,$database);

                    //check connection
                    if($connection->connect_error){ 
                        die("Connection failed: " . $connection->connect_error);
                    }

                    //read all row from database table
                    $sql = "Select * from products";
                    $result = $connection->query($sql);

                    if(!$result){
                        die("Invalid query: " . $connection->error);
                    }

                    //read data of each row
                    while($row = $result->fetch_assoc()){
                        echo "
                        <tr>
                            <td>$row[id]</td>
                            <td>$row[Name]</td>
                            <td>$row[Description]</td>
                            <td>$row[price]</td>
                            <td>$row[Quantity]</td>
                            <td>$row[Created_AT]</td>
                            <td>$row[Updated_AT]</td>   
                            <td>
                                <a class='btn btn-primary btn-sm' href='update.php?id=$row[id]'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='delete.php?id=$row[id]'>Delete</a>
                            </td>
                            </tr> ";
                    }
                ?>
        </tbody>
    </table>
</body>
</html>