<?php
    include '../server/functions.php';
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
            margin-left: 25%;
            margin-right: 25%;
        }

        .dropdown {
            border-bottom: solid black 1px;
            position: relative;
        }

        .dropdownHeader {
            font-size: 2rem;
            font-family: Roboto Light, serif;
            margin-left: 5px;
        }

        .dropdownHeader>p {
            margin: 0;
            padding: 12px 0;
        }

        .dropdownHeader>p>i {
            margin-left: 8px;
        }

        .arrow {
            border: solid black;
            border-width: 0 3px 3px 0;
            display: inline-block;
            padding: 3px;
            width: 8px;
            height: 8px;
            position: absolute;
            right: 20px;
            margin: 0;
        }

        .up {
            top: 27px;
            transform: rotate(-135deg);
            -webkit-transform: rotate(-135deg);
        }

        .down {
            top: 18px;
            transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
        }

        .enabled {
            display: block;
        }

        .disabled {
            display: none;
        }

        .dropdownContent {
            margin: 9px 16px;
            position: relative;
            padding-top: 56.25%;
            overflow: hidden;
        }

        .dropdownContent iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        @media screen and (max-width: 600px) {
            main {
                margin: 5px 10px;
            }
            .dropdownHeader {
                font-size: 1.3rem;
                text-align: center;
            }
            .dropdownHeader>p>i {
                position: inherit;
                display: block;
            }
        }
    </style>
    <script src="../../js/script.js"></script>
</head>
<body>
    <div id="page-container">
        <?= displayNav() ?>
        <script>
            selectedNavElement(2);
        </script>
        <header>
            <div class="headerText">Partners in Grime</div>
            <a href="javascript:void(0)" class="openSidebarButton" onclick="openNav()"> < </a>
        </header>
        <main>
            <div class="productTicker"></div>
            <div class="videoList">
                <div class="dropdown" id="i0">
                    <div class="dropdownHeader" onclick="dropdownToggle(0)">
                        <p>Tip #1    || <i>Short description #1</i><span class="arrow up"></span></p>
                    </div>
                    <div class="dropdownContent disabled">
                        <iframe src="https://www.youtube.com/embed/GrjQFE6_Fkw" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="dropdown" id="i1">
                    <div class="dropdownHeader" onclick="dropdownToggle(1)">
                        <p>Tip #2    || <i>Short description #2</i><span class="arrow up"></span></p>
                    </div>
                    <div class="dropdownContent disabled">
                        <iframe src="https://www.youtube.com/embed/GrjQFE6_Fkw" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="dropdown" id="i2">
                    <div class="dropdownHeader" onclick="dropdownToggle(2)">
                        <p>Tip #3    || <i>Short description #3</i><span class="arrow up"></span></p>
                    </div>
                    <div class="dropdownContent disabled">
                        <iframe src="https://www.youtube.com/embed/GrjQFE6_Fkw" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <span>Partners in Grime   2020 - 2021</span>
        </footer>
    </div>
</body>
</html>