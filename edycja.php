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
    <div class="sectionsWrap dodawanieWrap">
        <h1>Podaj nowe dane oferty (wypełnij wszystkie pola):</h1>
        <form action="" method="post" class="addForm">
            <div class="listElement">
                <label for="oferta">Podaj ID oferty do zmiany: </label>
                <input class="textInput" type="text" name="oferta" size=30 maxsize=3 />
            </div>
            <div class="listElement">
                <label for="nazwa">Podaj nazwę: </label>
                <input class="textInput" type="text" name="nazwa" size=30 maxsize=3 />
            </div>
            <div class="listElement">
                <label for="data">Podaj datę wydarzenia:</label>
                <input class="textInput" type="date" name="data" size=30 maxsize=3 />
            </div>
            <div class="listElement">
                <label for="godzina">Podaj godzinę wydarzenia:</label>
                <input class="textInput" type="time" name="godzina" size=30 maxsize=3 />
            </div>
            <div class="listElement">
                <label for="miejsca">Podaj liczbę dostępnych miejsc:</label>
                <input class="textInput" type="text" name="miejsca" size=30 maxsize=3 />
            </div>
            <div class="listElement">
                <label for="opis">Podaj krótki opis (Maksymalnie 150 znaków): </label>
                <input class="textInput" type="text" name="opis" size=30 maxsize=3 />
            </div>
            <div class="listElement">
                <label for="tagi">Podaj słowa kluczowe: </label>
                <input class="textInput" type="text" name="tagi" size=30 maxsize=3 />
            </div>
            <div class="listElement">
                <label for="platforma">Podaj platformę: </label>
                <input class="textInput" type="text" name="platforma" size=30 maxsize=3 />
            </div>
            <div class="buttonMenu">
                <input type="submit" name="akcja" value="Aktualizuj" class="button"/>
                <input type="submit" name="akcja" value="Porzuć" class="button"/>
                <input type="submit" name="akcja" value="Odśwież" class="button"/>
            </div>
        </form>
        <button class="buttonBack"><a href=index.php><p>Powrót na stronę główną</p></a></button>

        <section style="align-self: center;padding-top:20px;">
        <?php

        $akcja = $_POST['akcja'];
        $idoferty = $_POST['oferta'];
        
        //wyświetlanie rekordów użytkownika (podgląd aby wiedział co usuwa)
        try {
            require_once "baza_link.php";
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $loggeduser = $_SESSION['username'];
            $sql = "SELECT `Id`, `Nazwa_webinaru`, `Data_webinaru`, `Godzina`, `Liczba_miejsc`, `Opis`, `Tag`, `Platforma` 
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
                }catch(PDOException $err) {
                        echo "Błąd połączenia z bazą: " . $err->getMessage();
            }
                //Koniec wyświetlania tabeli
                
                
                //zmiana danych
                if(!empty($_POST['oferta']) && !empty($_POST['nazwa']) && !empty($_POST['data']) && !empty($_POST['godzina']) && !empty($_POST['miejsca']) 
                && !empty($_POST['opis']) && !empty($_POST['tagi']) && !empty($_POST['platforma']) && $akcja == "Aktualizuj"){
                
                require_once "baza_link.php";
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $id_oferty = $_POST['oferta'];

                $nazwa = $_POST['nazwa'];
                $data = $_POST['data'];
                $godzina = $_POST['godzina'];
                $liczba_miejsc = $_POST['miejsca'];
                $opis = $_POST['opis'];
                $tag = $_POST['tagi'];
                $platforma = $_POST['platforma'];

                    $sql = "UPDATE User_content SET Nazwa_webinaru= '$nazwa',Data_webinaru='$data',Godzina='$godzina',
                    Liczba_miejsc='$liczba_miejsc',Opis='$opis',Tag='$tag',Platforma='$platforma' WHERE Id = '$id_oferty'";
                    $conn->exec($sql);   
                    $conn->null;
                    
                } else if($akcja == "Porzuć"){
                    $_POST = array();
                }else if($akcja == "Odśwież"){
                    $_POST = array();
                }
                //koniec zmiany danych
        ?>
        </section>
    </div>

</body>
</html>