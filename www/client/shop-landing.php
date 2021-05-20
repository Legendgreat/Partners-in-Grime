<?php
    include "../server/functions.php";

    $pdo = makePDOConnection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Partners in Grime</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="../../css/style.css">
    <style>
        main {
            margin: 50px 20% 0;
        }

        .categoryList {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-gap: 50px;
        }
        .categoryItem {
            position: relative;
            margin-bottom: 100px;
            border: 1px solid black;
            border-radius: 8px;
            box-shadow: 1px 1px 5px black;
            width: 150px;
            height: 150px;
            justify-self: center;
            font-family: Roboto, serif;
        }
        .categoryContainer {
            position: absolute;
            bottom: 5px;
            width: 100%;
            text-align: center;
        }

        img {
            position: absolute;
            left: 25px;
            top: -105px;
            z-index: -1;
            width: 100px;
            height: 100px;
            object-fit: contain;
        }
        @media screen and (max-width: 600px) {
            .categoryList {
                grid-template-columns: 1fr 1fr;
                grid-gap: 30px;
            }
            img {
                width: 80px;
                height: 80px;
                top: -85px;

            }
            .categoryItem {
                width: 130px;
                height: 130px;
                margin-bottom: 20px;
            }
            main {
                margin: 50px 10% 0;
            }
        }
    </style>
    <script src="../../js/script.js"></script>
</head>
<body>
    <div id="page-container">
        <?= displayNav() ?>
        <script>
            selectedNavElement(1);
        </script>
        <header>
            <div class="headerText">Partners in Grime</div>
            <a href="javascript:void(0)" class="openSidebarButton" onclick="openNav()"> < </a>
        </header>
        <main>
            <div class="categoryList">
                <?php
                    $stm = $pdo->query("SELECT * FROM categories");
                    while($row = $stm->fetch())
                    {
                        $stm2 = $pdo->query("SELECT products_id FROM products_has_categories WHERE categories_id = ".$row['id']);
                        $firstProd = $stm2->fetch();
                        if ($firstProd != "") {
                            $stm3 = $pdo->query("SELECT images FROM products WHERE id = " . $firstProd['products_id']);
                            $images = explode(";", $stm3->fetch()["images"]);
                        }
                        echo "<a href='shop-listings.php?category=" . $row['id'] . "' class='categoryItem'><div class='categoryContainer'><img src='../../img/product-img/" . $images[0] . ".png' alt='X'><span>" . $row['name'] . "</span></div></a>";
                    }
                ?>
            </div>
        </main>
        <footer>
            <span>Partners in Grime   2020 - 2021</span>
        </footer>
    </div>
</body>
</html>