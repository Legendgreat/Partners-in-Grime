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
            margin: 0 25%;
            font-family: Roboto, serif;
        }

        .listingItem {
            display: grid;
            min-height: 80px;
            padding: 10px 5px;
            grid-template-areas:
            "a a b"
            "a a b"
            "a a b"
            "c c c"
            "c c c";
        }

        .productArea {
            display: grid;
            grid-area: a;
            grid-template-rows: 1fr 3fr 1fr;
        }

        .productArea>img {
            object-fit: contain;
            height: 300px;
            width: 300px;
            border: 1px solid black;
            border-radius: 5px;
            margin-left: 5px;
        }

        .productPic {
            display: inline-block;
            margin-top: 5px;
            margin-right: 16px;
            margin-left: -8px;
        }

        .productPic>img {
            width: 65px;
            height: 65px;
            border: 1px solid black;
            border-radius: 5px;
            object-fit: contain;
        }

        .productPic>img:hover{
            box-shadow: 0 0 8px gray;
            border: 1px solid blue;
        }

        .selectedPic {
            border-color: orange !important;
        }

        #name {
            margin-top: 5px;
            margin-left: -30px;
            font-size: 1.5rem;
            align-self: center;
        }

        #stock {
            font-size: 1.2rem;
            grid-area: b;
            padding: 8px 0 12px;
        }

        .priceArea {
            width: 150px;
            padding: 15px 10px 15px 25px;
            display: grid;
            grid-area: b;
            grid-template-areas:
            'a'
            'b'
            'c';
            align-self: center;
            margin-top: -70px;
            border: 1px solid black;
            border-radius: 5px;
            box-shadow: 2px 2px 5px gray;
        }

        #price {
            grid-area: a;
            font-size: 2.5rem;
            align-self: center;
        }

        .priceArea>#cart {
            font-size: 1.2rem;
            grid-area: c;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .priceArea>#cart>input {
            width: 45px;
            align-self: center;
        }

        .descriptionArea {
            font-size: 1.1rem;
            margin-left: -25px;
            grid-area: c;
        }
        @media screen and (max-width: 600px) {
            main {
                margin: 0 5%;
            }
            .listingItem {
                margin: 0 0 10px;
                grid-template-areas:
            "a"
            "a"
            "a"
            "c"
            "c"
            "b"
            "b";
            }
            .productArea {
                margin: 0 auto;
            }
            #name {
                margin-top: -20px;
            }
            .descriptionArea {
                margin: 0 auto;
            }
            .priceArea {
                width: 80%;
                margin: 20px auto 0;
            }
            #price {
                margin: 0 auto;
            }
        }
    </style>
    <script src="../../js/jquery-3.5.1.js"></script>
    <script src="../../js/script.js"></script>
</head>
<body onload="firstPicSelected()">
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
            <div id="test"></div>
            <div class="productList">
                <?php
                    $stm = $pdo->query("SELECT * FROM products WHERE id='".$_GET['id']."'");
                    //$testValue = fmod($row["price"], 1);
                    $row = $stm->fetch();

                    $imgArray = explode(";", $row["images"]);
                    $imgArrayString = "";
                    $price = $row["price"];

                    foreach($imgArray as $string){
                        $imgArrayString .= "<div class='productPic' onclick='changePic(\"".$string."\");'><img src='../../img/product-img/".$string.".png' alt='".$string."' id='".$string."'></div>";
                    }

                    if ($row['stock'] > 0) {
                        $stockString = '
                            <span id="price">£'. $price .'</span>
                            <span id="stock" style="color: green;">◉ In stock</span>
                            <div id="cart">
                                <input type="number" name="amount" value="1" min="1">
                                <input type="hidden" name="product" value="'. $row['id'] . '">
                                <input type="image" src="../../img/cart.png" alt="Submit" style="margin-bottom: 3px;" onclick="addToCart(0)">
                            </div>
                        ';
                    } else {
                        $stockString = '
                            <span id="price">£'.$price.'</span>
                            <span id="stock" style="color: red;">◉ Not in stock</span>
                        ';
                    }

                    if (fmod($price, 1) == 0) {
                        $price = $price . ',-';
                    }

                    $price = str_replace('.', ',', strval($price));

                    echo '
                         <div class="listingItem" onclick="">
                            <div class="productArea">
                                <span id="name">' . $row["name"] . '</span>
                                <img id="bigPic" src="../../img/product-img/'. $imgArray[0] .'.png" alt="X">
                                <div class="pictureList">
                                    '.$imgArrayString.'
                                </div>
                            </div>
                            <div class="priceArea">'.$stockString.'</div>
                            <div class="descriptionArea">
                                <p style="margin: 5px;">' . $row['description'] . '</p>
                            </div>
                         </div>
                    ';
                ?>
            </div>
        </main>
        <footer>
            <span>Partners in Grime   2020 - 2021</span>
        </footer>
    </div>
</body>
</html>