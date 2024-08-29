<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "mean_mean";

    //create connection 
    $connection = new mysqli($servername, $username, $password, $database);

    $name = "";
    $description = "";
    $price = "";
    $Quantity = "";



    $errorMessage = "";
    $successMessage = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST["Name"];
        $description = $_POST["Description"];
        $price = $_POST["Price"];
        $Quantity = $_POST["Quantity"];

        do {
            if(empty($name) || empty($description) || empty($price) || empty($Quantity)){
                $errorMessage = "All the field are required";
                break;
            }

            // add new account to database
            $sql = "INSERT INTO products (Name,Description,Price,Quantity)" .
                    "VALUES ('$name','$description','$price','$Quantity')";
            $result = $connection->query($sql);

            if(!$result){
                $errorMessage = "Invalid query: " . $connection->error;
                break;
            }

            $Name ="";
            $Description ="";
            $price ="";
            $Quantity = "";


            $successMessage = "Product added correctly";

            header("location: \New_folder\mhean\index.php");
            exit;

        }while(false);
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create accounts</title>
        
    </head>
    <body style="background-color: lightblue;">
        <div class="container my-5">
            <h2>New accounts</h2>

            <?php
            if(!empty($errorMessage)){
                echo"
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                </div>
                ";
            }
            ?>

            <form method="post">
                <div>
                    <label class="col-sm-3 col-form-label">Name</label>
                    <div>
                        <input type="text" class="form-control" name="Name" value="<?php echo $name; ?>">
                    </div>
                </div>
                <div>
                    <label class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="Description" value="<?php echo $description; ?>">
                    </div>
                </div>
                <div >
                    <label class="col-sm-3 col-form-label">Price</label>
                    <div>
                        <input type="text" class="form-control" name="Price" value="<?php echo $price; ?>">
                    </div>
                </div>
                <div >
                    <label class="col-sm-3 col-form-label">Quantity</label>
                    <div >
                        <input type="text" class="form-control" name="Quantity" value="<?php echo $Quantity; ?>">
                    </div>
                </div>
                
                
                <?php
                if(!empty($successMessage)){
                    echo"
                    <div class= 'row mb-3'>
                        <div class='offset-sm-3 col-sm-6'>
                            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>$successMessage</strong>
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                            </div>
                        </div>
                    </div>

                    ";
                }
                ?>
                
                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid" >
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="col-sm-3 d-grid">
                        <a class="btn btn-outline-primary" href=".php" role="button">Cancel</a>
                    </div>
                </div>

            </form>
        </div>
    </body>
    </html>