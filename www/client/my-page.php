<?php
include '../server/functions.php';

$pdo = makePDOConnection();

if (isset($_COOKIE['session_id']) && !empty($_COOKIE['session_id'])) {
    $stm = $pdo->prepare('SELECT * FROM users INNER JOIN sessions ON users.id = sessions.users_id WHERE sessions.id = ?');
    $stm->execute([$_COOKIE['session_id']]);
    $user = $stm->fetch();
} else {
    header('Location: index.php');
}

$genderElement = '';
$countryElement = '';
if (!isset($user['company']) || empty($user['company'])) {
    $user['company'] = "";
}

$user['first'] = explode(', ', $user['name'])[1];
$user['last'] = explode(', ', $user['name'])[0];

switch ($user['country']) {
    case "uk":
        $countryElement = '
            <select name="country" required>
                <option value="" disabled>Select your country</option>
                <option value="uk" selected>United Kingdom</option>
                <option value="nl">Netherlands</option>
            </select>
        ';
        break;
    case "nl":
        $countryElement = '
            <select name="country" required>
                <option value="" disabled>Select your country</option>
                <option value="uk">United Kingdom</option>
                <option value="nl" selected>Netherlands</option>
            </select>
        ';
        break;
    default:
        $countryElement = '
            <select name="country" required>
                <option value="" disabled selected>Select your country</option>
                <option value="uk">United Kingdom</option>
                <option value="nl">Netherlands</option>
            </select>
        ';
        break;
}

switch ($user['gender']) {
    case "m":
        $genderElement = '
            <label>
                <input type="radio" id="male" name="gender" value="m" checked required>
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
        ';
        break;
    case "f":
        $genderElement = '
            <label>
                <input type="radio" id="male" name="gender" value="m" required>
                Mr.
            </label>
            <label>
                <input type="radio" id="female" name="gender" value="f" checked required>
                Ms.
            </label>
            <label>
                <input type="radio" id="other" name="gender" value="o" required>
                Other
            </label><br>
        ';
        break;
    case "o":
        $genderElement = '
            <label>
                <input type="radio" id="male" name="gender" value="m" required>
                Mr.
            </label>
            <label>
                <input type="radio" id="female" name="gender" value="f" required>
                Ms.
            </label>
            <label>
                <input type="radio" id="other" name="gender" value="o" checked required>
                Other
            </label><br>
        ';
        break;
    default:
        $genderElement = '
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
        ';
        break;
}
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
            padding-left: 42px;
            width: 156px;
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
        selectedNavElement(6);
    </script>
    <header>
        <a href="javascript:void(0)" class="openAsideButton" onclick="openAside()"> > </a>
        <div class="headerText">Partners in Grime</div>
        <a href="javascript:void(0)" class="openSidebarButton" onclick="openNav()"> < </a>
    </header>
    <?= displayAside() ?>
    <script>
        selectedAsideElement(0);
    </script>
    <main>
        <div class="formContainer">
            <form method="post" action="../server/modify-user.php">
                <label>Gender *</label><br>
                <?=$genderElement?>
                <label class="inputField">
                    First name * <br>
                    <input type="text" name="first" value="<?=$user['first']?>" required>
                </label>
                <label class="inputField">
                    Last name * <br>
                    <input type="text" name="last" value="<?=$user['last']?>" required>
                </label><br>
                <label class="inputField">
                    E-mail address * <br>
                    <input type="text" name="email" value="<?=$user['email']?>" required>
                </label>
                <label class="inputField">
                    Repeat e-mail address * <br>
                    <input type="text" name="repeatEmail" required>
                </label><br>
                <label class="inputField">
                    Company name <br>
                    <input type="text" name="company" value="<?=$user['company_name']?>">
                </label><br>
                <label class="inputField">
                    Country * <br>
                    <?=$countryElement?>
                </label><br>
                <label class="inputField">
                    City * <br>
                    <input type="text" name="city" value="<?=$user['city']?>" required>
                </label>
                <label class="shortField">
                    Postal code * <br>
                    <input type="text" name="zip"  value="<?=$user['zip']?>" required>
                </label><br>
                <label class="inputField">
                    Address * <br>
                    <input type="text" name="address"  value="<?=$user['address']?>" required>
                </label><br>
                <label class="inputField">
                    Birth date * <br>
                    <input type="date" name="birthdate"  value="<?=$user['birth_date']?>" required>
                </label><br>
                <label class="inputField">
                    Phone nr. * <br>
                    <input type="text" name="phoneNr"  value="<?=$user['phonenr']?>" required>
                </label><br>
                <div class="submitContainer">
                    <input type="submit" value="Modify">
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