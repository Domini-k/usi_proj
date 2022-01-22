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
    <h1>Podaj dane swojego Webinaru</h1>
    <form action="" method="post" class="addForm">
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
            <input type="submit" name="akcja" value="Dodaj" class="button"/>
            <input type="submit" name="akcja" value="Porzuć" class="button"/>
        </div>
    </form>
    <a href=main.php><button class="button"><p>Powrót do panelu</p></button></a>
</div>
 
<?php
$akcja = $_POST["akcja"];

if(!empty($_POST['nazwa']) && !empty($_POST['data']) && !empty($_POST['godzina']) && !empty($_POST['miejsca'])
&& !empty($_POST['tagi']) && !empty($_POST['platforma']) && !empty($_POST['opis']) && $akcja=="Dodaj"){

  $nazwa = $_POST['nazwa'];
  $data = $_POST['data'];
  $godzina = $_POST['godzina'];
  $miejsca = $_POST['miejsca'];
  $tagi = $_POST['tagi'];
  $platforma = $_POST['platforma'];
  $opis = $_POST['opis'];
  $wlasciciel = $_SESSION['username'];

    
  try {
            require_once "baza_link.php";
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO `User_content`(`Nazwa_webinaru`, `Data_webinaru`, `Godzina`, `Liczba_miejsc`, `Opis`, `Tag`, `Platforma`, `Wlasciciel`)
            VALUES ('$nazwa','$data','$godzina','$miejsca','$opis','$tagi','$platforma','$wlasciciel')";
            
            $conn->exec($sql);
            echo 'Dodano ofertę!';
            $conn = null;


        
      }catch(PDOException $err) {
    	echo "Błąd połączenia z bazą: " . $err->getMessage();
      }
} else if($akcja=="Porzuć"){
$_POST = array();

}else if($akcja=="Dodaj"){
echo "Wypełnij wszystkie dane!";
}

?>
</body>
</html>