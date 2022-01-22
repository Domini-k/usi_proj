<?php
session_start();

if(isset($_SESSION['username'])){
header("Location: main.php");
}
?>


<!DOCTYPE html>
<html lang="pl-PL">

<head>

    <meta charset="UTF-8">
    <title>Autoryzacja użytkowników</title>
    <link rel="stylesheet" href="styles/styles.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <div class="sectionsWrap">
        <section class="navi">
            <a href="https://thepadproject.is-great.net"><img src="images/logo.png" alt="logo"></a>
            <h1 class="napis">WEBINARY</h1>
            <button class="button"><a href=oferty.php><p>Przeglądaj jako gość</p></a></button>
            <button class="button"><a href=rejestracja.php><p>Rejestracja</p></a></button>
        
        </section>

        <section class="main">
            <?php
            if(isset($_SESSION['login_error'])){
                //echo $_SESSION['login_error'];
                echo "<h1 style=\"padding:20px; border:2px solid #FAFAFA;text-align: center;\">". $_SESSION['login_error'] ."</h1>";
                $_SESSION['login_error'] = null;
            }
            
            ?>
            <form action="zaloguj.php" method="post" class="recaptchaForm">
                <h1>Logowanie</h1>
                <input type="text" name="login" class="textInput" id="login" placeholder="Login" required/>
                <input type="password" name="haslo" class="textInput" id="haslo" placeholder = "Hasło" required />
                <input type="submit" value="Zaloguj się" class="button submitButton" />
            </form>
        </section>
        <section class="footer">
            <hr>
            <p>Projekt <br><br>
                Dominik Jagódzki<br>
                Patryk Lenart<br>
                Andrzej Małowiecki
            </p>
        </section>
    </div>
</body>

</html>