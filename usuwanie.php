<?php
session_start();
if(!isset($_SESSION['username'])){
header("Location: index.php");}
?>

<html lang="pl-PL">
<head>
<meta charset="utf-8"> 
<link rel="stylesheet" href="styles/styles.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital@1&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&display=swap" rel="stylesheet">  
</head>
<body>
 <div class="sectionsWrap usunPhpWrap">
    <form action="" method="post" class="formReje usunPhpForm">
    <h1>Podaj ID oferty którą chcesz usunąć:</h1>
    <input class="textInput" type="text" name="oferta" size=30 maxsize=3/>
    <input type="submit" name="akcja" value="Usuń" class="buttonReje" id="submitButton"/>
    </form>
    <button class="buttonBack"><a href=index.php><p>Powrót na stronę główną</p></a></button>
    <?php

    $akcja = $_POST["akcja"];
    $idoferty = $_POST['oferta'];
    
    require_once "baza_link.php";
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        

    //wyświetlanie rekordów użytkownika (podgląd aby wiedział co usuwa)
    try {
        require_once "baza_link.php";
        $loggeduser = $_SESSION['username'];
        $sql = "SELECT `Id`, `Nazwa_webinaru`, `Data_webinaru`, `Godzina`, `Liczba_miejsc`, `Opis`, `Tag`, `Platforma`,`Wlasciciel` 
                FROM `User_content` 
                WHERE Wlasciciel = '$loggeduser'";

        $p_lp=0;
        
        echo "<table border=3>
        <tr>
        <th>ID oferty</th>
        <th>Nazwa</th>
        <th>Data</th>
        <th>Godzina</th>
        <th>Liczba miejsc</th>
        <th>Krótki opis wydarzenia</th>
        <th>Słowa kluczowe</th>
        <th>Platofrma</th>
        </tr>";
        
        foreach ($conn->query($sql) as $row) 
        {
            $pole1=$row['Id'];
            $pole2=$row['Nazwa_webinaru'];
            $pole3=$row['Data_webinaru'];
            $pole4=$row['Godzina'];
            $pole5=$row['Liczba_miejsc'];
            $pole6=$row['Opis'];
            $pole7=$row['Tag'];
            $pole8=$row['Platforma'];
            $p_lp++;
            
            echo "<tr><td>" . $pole1. "</td><td>" . $pole2. "</td><td>" . $pole3. "</td>
            <td>" . $pole4. "</td><td>" . $pole5. "</td><td>" . $pole6. "</td><td>" . $pole7 ."</td><td>" . $pole8 . "</td></tr>";
            
            echo "<br>";
            }
            echo "</table>";
            $conn->null;
            }
            catch(PDOException $err) {
            echo "Błąd połączenia z bazą: " . $err->getMessage();
        }
            
            if(!empty($_POST['oferta']) && $akcja == "Usuń"){
            require_once "baza_link.php";
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "DELETE FROM User_content WHERE Id = '$idoferty' AND Wlasciciel = '$loggeduser'";
            $conn->exec($sql);
            $conn->null;

            }
    ?>
</div>
</body>
</html>