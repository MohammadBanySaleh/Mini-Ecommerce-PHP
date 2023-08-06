<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .product-card {
            display: inline-block;
            width: 300px;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            text-align: center;
        }

        .product-image {
            padding: 15px;
            border: none;
            height: auto;
            width: auto;
            max-width: 100%;
            max-height: 250px;
            border: 1px solid #ccc;
        }

        .card {
            width: 250px;
            min-height: 427px;
            margin: auto;
        }

        .card:hover {
            box-shadow: 0 0 20px rgba(9, 117, 241, 0.8);
            border-color: #0974f1;
            transform: scale(1.03);
        }

        .navLink {
            font-size: 16px;
            font-weight: normal;
        }

        .superNav {
            font-size: 13px;
        }

        .navFormControl {
            outline: none !important;
            box-shadow: none !important;
        }

        .logo {
            font-size: 30px;
        }

        @media screen and (max-width:540px) {
            .centerOnMobile {
                text-align: center
            }
        }

        #test {
            display: none;
            margin-left: 30px;
        }
        .card:hover  #test {
            display: inline;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>

    <?php
    require_once './includes/nav.php';
    ?>

    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-sm-1 g-4">

            <?php

            if (isset($_SESSION['products'])) {
                foreach ($_SESSION['products'] as $product) {
                    echo "<div class='col'>
                            <div class='card'>
                                <img class='product-image' src='{$product['picture']}' alt='{$product['name']}'>
                                <div class='card-body'>
                                    <h5 class='card-title'>{$product['name']}</h5>
                                    <p class='card-text'>{$product['brief']}</p>
                                    <p style='display: inline'><b>Price: \${$product['price']}</b></p>
                                
                                    
                                    <button type='button' class='btn btn-outline-success btn-sm' id='test'>Add to Cart</button>
                                </div>
                                
            
                            </div>
                        </div>";
                }
            }
            ?>
        </div>
    </div><br><br><br><br>
    
    <?php
    require_once './includes/footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>