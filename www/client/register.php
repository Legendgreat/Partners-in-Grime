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
            margin: 0 20%;
            font-family: Roboto, serif;
            min-height: 80vh;
        }
        .formContainer {
            margin: 30px 31%;
        }
        form {
            position: relative;
        }
        label {
            display: inline-block;
            padding-bottom: 8px;
            padding-right: 8px;
        }
        input, select {
            margin-top: 5px;
            margin-bottom: 15px;
            text-align: center;
            font-size: 1em;
        }
        input[type=text]{
            height: 22px;
        }
        select{
            padding: 2px;
            width: 203px;
            height: 28px;
        }
        input[type=date] {
            width: 198px;
            height: 26px;
        }
        .submitContainer {
            justify-content: center;
        }
        input[type=submit] {
            display: inline-block;
            width: 100%;
            height: 28px;
            border: none;
            border-radius: 3px;
            background-color: #c0ff9b;
        }
        input[name=birthdate] {

        }
        .shortField>input {
            width: 75px;
        }
        @media screen and (max-width: 600px) {
            main {
                margin: 0;
            }
            .formContainer {
                margin: 30px 4.8%;
            }
            input, select {
                margin-bottom: 12px;
                font-size: 0.85em;
            }
            input[type=text]{
                height: 22px;
            }
            select{
                padding: 2px;
                width: 176px;
                height: 28px;
            }
            input[type=date] {
                padding-left: 42px;
                width: 130px;
                height: 26px;
            }
        }
    </style>
    <script src="../../js/script.js"></script>
</head>
<body>
<div id="page-container">
    <?= displayNav() ?>
    <script>
        selectedNavElement(5);
    </script>
    <header>
        <div class="headerText">Partners in Grime</div>
        <a href="javascript:void(0)" class="openSidebarButton" onclick="openNav()"> < </a>
    </header>
    <main>
        <div class="formContainer">
            <form method="post" action="../server/add-user.php">
                <label>Gender *</label><br>
                <label>
                    <input type="radio" id="male" name="gender" value="m" required>
                    Mr.
                </label>
                <label>
                    <input type="radio" id="female" name="gender" value="f" required>
                    Ms.
                </label>
                <label>
                    <input type="radio" id="other" name="gender" value="o" required>
                    Other
                </label><br>
                <label class="inputField">
                    First name * <br>
                    <input type="text" name="first" required>
                </label>
                <label class="inputField">
                    Last name * <br>
                    <input type="text" name="last" required>
                </label><br>
                <label class="inputField">
                    E-mail address * <br>
                    <input type="text" name="email" required>
                </label>
                <label class="inputField">
                    Repeat e-mail address * <br>
                    <input type="text" name="repeatEmail" required>
                </label><br>
                <label class="inputField">
                    Password * <br>
                    <input type="password" name="password" required>
                </label>
                <label class="inputField">
                    Repeat password * <br>
                    <input type="password" name="repeatPassword" required>
                </label><br>
                <label class="inputField">
                    Company name <br>
                    <input type="text" name="company">
                </label><br>
                <label class="inputField">
                    Country * <br>
                    <select name="country" required>
                        <option value="" disabled selected>Select your country</option>
                        <option value="uk">United Kingdom</option>
                        <option value="nl">Netherlands</option>
                    </select>
                </label><br>
                <label class="inputField">
                    City * <br>
                    <input type="text" name="city" required>
                </label>
                <label class="shortField">
                    Postal code * <br>
                    <input type="text" name="zip" required>
                </label><br>
                <label class="inputField">
                    Street name * <br>
                    <input type="text" name="street" required>
                </label>
                <label class="shortField">
                    House nr. * <br>
                    <input type="text" name="houseNr" required>
                </label><br>
                <label class="inputField">
                    Birth date * <br>
                    <input type="date" name="birthdate" required>
                </label><br>
                <label class="inputField">
                    Phone nr. * <br>
                    <input type="text" name="phoneNr" required>
                </label><br>
                <input type="hidden" name="from" value="<?= $_GET['from'] ?>">
                <div class="submitContainer">
                    <input type="submit" value="Register">
                </div>
            </form>
        </div>
    </main>
    <footer>
        <span>Partners in Grime   2020 - 2021</span>
    </footer>
</div>
</body>
</html>