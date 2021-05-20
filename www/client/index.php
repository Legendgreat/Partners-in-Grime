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
        .companyInformation {
            display: grid;
            grid-template-columns: 1fr 1fr;
            justify-items: center;
        }

        .companyInformation>p {
            text-align: center;
            font-family: "Roboto", "serif";
            font-size: 1.1em;
            width: 500px;
            margin-right: 200px;
        }

        .companyInformation>img {
            margin-top: 20px;
            margin-left: 200px;
            object-fit: cover;
            object-position: 82% 0;
            height: 500px;
            width: 500px;
        }

        @media screen and (max-width: 600px) {
            .companyInformation {
                display: block;
                grid-template-columns: 0;
            }
            .companyInformation>p {
                width: 90%;
                font-size: 0.8em;
                margin: 10px auto;
            }
            .companyInformation>img {
                display: block;
                height: 250px;
                width: 250px;
                margin: 0 auto;

            }
        }
    </style>
    <script src="../../js/script.js"></script>
</head>
<body>
    <div id="page-container">
        <?= displayNav() ?>
        <script>
            selectedNavElement(0);
        </script>
        <header>
            <div class="headerText">Partners in Grime</div>
            <a href="javascript:void(0)" class="openSidebarButton" onclick="openNav()"> < </a>
        </header>
        <main>
            <div class="productTicker"></div>
            <div class="companyInformation">
                <img src="../../img/company%20image.png" alt="Company Picture">
                <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br>
                    Volutpat ac tincidunt vitae semper quis lectus. Est ullamcorper eget nulla facilisi etiam dignissim. Adipiscing vitae proin sagittis nisl.<br>
                    Scelerisque fermentum dui faucibus in ornare quam. Viverra justo nec ultrices dui sapien eget. Diam maecenas ultricies mi eget mauris pharetra et ultrices.<br>
                    Et egestas quis ipsum suspendisse ultrices gravida. Enim ut tellus elementum sagittis vitae et. Sodales neque sodales ut etiam sit amet nisl purus in. <br>
                    Leo urna molestie at elementum. Quis auctor elit sed vulputate mi sit.<br><br>
                    Urna condimentum mattis pellentesque id nibh tortor id aliquet lectus. Est velit egestas dui id. Consequat id porta nibh venenatis cras sed felis. <br>
                    Facilisis magna etiam tempor orci eu lobortis elementum. Aliquam faucibus purus in massa. Massa tempor nec feugiat nisl pretium. Ac auctor augue mauris augue neque gravida. <br>
                    Eget egestas purus viverra accumsan in nisl nisi scelerisque eu. Tristique magna sit amet purus gravida quis blandit. Sed viverra ipsum nunc aliquet bibendum.<br>
                    Nunc faucibus a pellentesque sit amet porttitor eget dolor morbi.</p>
            </div>
        </main>
        <footer>
            <span>Partners in Grime   2020 - 2021</span>
        </footer>
    </div>
</body>
</html>