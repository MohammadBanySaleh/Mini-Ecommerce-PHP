<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        <?php require_once './includes/navStyle.php'?>
    </style>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this product?");
        }
    </script>
</head>

<body>
    <?php
    session_start();

    if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
        $indexToDelete = $_GET['delete'];
        if (isset($_SESSION['products'][$indexToDelete])) {
            unset($_SESSION['products'][$indexToDelete]);
        }
    }




    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $name = $_POST['name'];
        $brief = $_POST['brief'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $picture = $_FILES['picture']['name'];

        // Save the uploaded picture in the "uploads" directory
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($picture);
        move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile);

        // Create a new product array
        $product = array(
            'name' => $name,
            'description' => $description,
            'brief' => $brief,
            'price' => $price,
            'picture' => $uploadFile
        );

        // Store the product in the session variable
        if (!isset($_SESSION['products'])) {
            $_SESSION['products'] = array();
        }
        $_SESSION['products'][] = $product;
        // unset($_POST['submit']);
        header("Location: index.php");
        exit();
    }
    ?>

    <?php
    require_once './includes/nav.php';
    ?>



    <div class="container">
        <h2>Add Product</h2><br>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3 form">
                <label for="name" class="form-label">Product Name:</label>
                <input class="form-control" type="text" name="name" placeholder="Name" aria-label="default input example">
            </div>

            <div class="mb-3 form">
                <label for="brief" class="form-label">Brief specifications</label>
                <input class="form-control" type="text" id="brief" name="brief">
                <p style="color: grey;">ie: mention the storage, processor, ram..</p>
            </div>

            <div class="mb-3 form">
                <label for="description" class="form-label">Product Description:</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>

            <div class="mb-3 form">
                <label for="price" class="form-label">Product price</label>
                <input class="form-control" type="text" id="price" name="price">
            </div>

            <div class="mb-3 form">
                <label for="picture" class="form-label">Product picture</label>
                <input class="form-control" type="file" id="picture" name="picture">
            </div>

            <button type="submit" class="btn btn-outline-success" name="submit" value="Add Product">Add product</button>
        </form>

    </div><br><br>


    <div class="container">
        <h2>Added Products</h2>
        <table class="table table-hover table-bordered border-secondary-subtle table-responsive table-info">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Picture</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                if (isset($_SESSION['products'])) {
                    foreach ($_SESSION['products'] as $index => $product) {
                        echo "<tr class='align-middle'>
                        <td>{$product['name']}</td>
                        <td class='desc'>{$product['description']}</td>
                        <td>{$product['price']}</td>
                        <td><img src='{$product['picture']}' alt='Product Picture' width='100'></td>
                        <td>
                        <a href='?delete={$index}' onclick='return confirmDelete()' '>
                        <button type='button' class='btn btn-outline-danger'>Delete</button>   
                        </a>
                        </td>
                        </tr>";
                    }
                }
                ?>

            </tbody>


        </table>

    </div><br><br><br><br>

    <?php
    require_once './includes/footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>