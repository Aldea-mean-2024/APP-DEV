<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mean_mean";

$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$name = "";
$description = "";
$price = "";
$Quantity = "";

$errorMessage = "";
$successMessage = ""; // Fixed the typo here

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: /New_folder/mhean/index.php");
        exit;
    }
    $id = $_GET["id"];

    $sql = "SELECT * FROM products WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /New_folder/mhean/index.php");
        exit; // Added an exit to ensure no further code is executed
    }

    $name = $row["Name"];
    $description = $row["Description"];
    $price = $row["price"];
    $Quantity = $row["Quantity"]; // Fixed the variable name from $address to $Quantity
} else {
    $id = $_POST["id"];
    $name = $_POST["Name"]; // Fixed the variable name from $Name to $name
    $description = $_POST["Description"]; // Fixed the variable name from $Description to $description
    $price = $_POST["price"];
    $Quantity = $_POST["Quantity"];

    do {
        if (empty($name) || empty($description) || empty($price) || empty($Quantity)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE products SET Name = '$name', Description = '$description', price = '$price', Quantity = '$Quantity' WHERE id = '$id'";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Account updated correctly"; // Fixed the typo here

        header("location: /New_folder/mhean/index.php");
        exit;

    } while (false);
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
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
            </div>
            ";
        }
        ?>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div>
                <label class="col-sm-3 col-form-label">Name</label>
                <div>
                    <input type="text" class="form-control" name="Name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div>
                <label class="col-sm-3 col-form-label">Description</label>
                <div>
                    <input type="text" class="form-control" name="Description" value="<?php echo $description; ?>">
                </div>
            </div>
            <div>
                <label class="col-sm-3 col-form-label">Price</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="price" value="<?php echo $price; ?>">
                </div>
            </div>
            <div>
                <label class="col-sm-3 col-form-label">Quantity</label>
                <div>
                    <input type="text" class="form-control" name="Quantity" value="<?php echo $Quantity; ?>">
                </div>
            </div>
            
            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
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
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
