<?php
session_start();

if(isset($_SESSION['username'])){
header("Location: main.php");
}
?>
<html lang="pl-PL">
<head>
<meta charset="utf-8">
<title>Rejestracja</title>
<link rel="stylesheet" href="styles/styles.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
<div class="sectionsWrap">
    <section class="navi">
            <a href=index.php><img src="images/logo.png" alt="logo"></a>
            <h1 class="napis">WEBINARY</h1>
            <button class="button"><a href=oferty.php><p>Przeglądaj jako gość</p></a></button>
            <button class="button"><a href=rejestracja.php><p>Rejestracja</p></a></button>
        
        </section>
    
    <?php
        if(isset($_POST['akcja'])){
            $akcja = $_POST['akcja'];
        }
        
        if(isset($_POST['login']) && $akcja=='Dodaj')
        {
        
                $sekret = "6Le2yz8aAAAAADfwEB68lI3dqk8W3uWyT1p8u9Jh";
    	
                $sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
		
                $odpowiedz = json_decode($sprawdz);
		
                if ($odpowiedz->success==false)
                {
                        echo '<h1 style="padding:20px; border:2px solid #FAFAFA;text-align: center;">'.'POTWIERDŹ, ŻE NIE JESTEŚ BOTEM'.'</h1>';
                }
                else
                {
            
                        $wpisaneCaptcha = strval($_POST['wpisaneNumery']);
                        $wylosowaneCaptcha = strval($x);    
           
            
                        if($wpisaneCaptcha==$wylosowaneCaptcha){    
                                $login_user = $_POST ['login'];
                                $haslo= $_POST ['haslo'];
                                $data = date("Y-m-d");
        
                                include "baza_link.php";
                                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $sql1 = "select * FROM Users where login='$login_user'";
    
                                $stmt = $conn->query($sql1);
                                $rows = $stmt->fetchAll();
                                $num_rows = count($rows);
        
                                if ($num_rows == 0)
                                {
                                    try {
                                        //include "baza_link.php";
                                        //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                                        $sql = "INSERT INTO Users (Login, Haslo, Data_zal) VALUES ('$login_user', '$haslo', '$data')";
                                        $conn->exec($sql);
                                        $conn = null;
                    
                                        echo '<h1 style="padding:20px; border:2px solid #FAFAFA;text-align: center;">'.'POMYŚLNIE UTWORZONO KONTO!'.'<br>'.'Login: '.$login_user.'</h1>';

                                }
                                catch(PDOException $err) 
                                {
                                        echo "Błąd: brak połączenia z bazą danych! " . $err->getMessage();
                                }
                                }
                                else echo '<h1 style="padding:20px; border:2px solid #FAFAFA;text-align: center;">'.'PODANY LOGIN JEST JUŻ ZAJĘTY'.'</h1>';
                        }
                        else{
                                echo '<h1 style="padding:20px; border:2px solid #FAFAFA;text-align: center;">'.'NIEPOPRAWNY KOD CAPTCHA'.'</h1>';
                        }
                }
                
        }
        
    ?>
    
    
    <form action="" method="post" class="formReje recaptchaForm">
        <h1>Podaj dane do założenia konta:</h1>
  
        <input class="textInput" type="text" name="login" size=30 maxsize=3 placeholder="Login" required/>

        <input class="textInput" type="password" name="haslo" size=30 maxsize=3 placeholder="Hasło" required/>
        <div class="g-recaptcha" data-sitekey="6Le2yz8aAAAAAI6Mf7hIFFWMaFcn1JyNT4k5TecY"></div>
        <input type="submit" name="akcja" value="Dodaj" class="buttonReje" id="submitButton"/>
        <input type="submit" name="akcja" value="Zresetuj wpisane pola" class="buttonReje" id="submitButton"/>

    </form>        
    <button class="buttonBack"><a href=index.php><p>Powrót na stronę główną</p></a></button>
    
    <div class="footer">

        <hr>
                <p>Zadanie na laboratoria6 <br>
                    Dominik Jagódzki<br>
                    Patryk Lenart<br>
                    Andrzej Małowiecki
                </p>
    </div>
</div>
</body>
</html>