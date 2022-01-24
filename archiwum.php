<?php
  session_start();
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
    <div class="mainGuestBrowseContent" style="    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 30px;">
        <?php 
  if(isset($_SESSION['username'])){
    echo "<h1 style=\"padding:20px; border:2px solid #FAFAFA;text-align: center;\">"."Witaj ". $_SESSION['username'] . "!"."</h1>";
  } else {
    echo "<h1 style=\"padding:20px; border:2px solid #FAFAFA;text-align: center;\">Obecnie przeglądasz archiwum webinarów jako gość."."<br>"."Zaloguj się a otrzymasz możliwość dodawania własnych webinarów do naszej strony!</h1>";}
  ?>
        <?php
    
    try {
        require_once "baza_link.php";
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo 'Poprawne połączenie z bazą <br>';
        
        $dzis=date("Y-m-d");
        //$sql = "SELECT`Nazwa_webinaru`, `Data_webinaru`, `Godzina`, `Liczba_miejsc`, `Opis`, `Tag`, `Platforma`, `Wlasciciel` FROM `User_content` WHERE `Data_webinaru`<'$dzis'";
        
        $data = $conn->query("SELECT`Nazwa_webinaru`, `Data_webinaru`, `Godzina`, `Liczba_miejsc`, `Opis`, `Tag`, `Platforma`, `Wlasciciel` FROM `User_content` WHERE `Data_webinaru`<'$dzis' ORDER BY Data_webinaru")->fetchAll();

        $p_lp=0;
        
        echo "<table border=3>
        <tr>
        <th>Nazwa</th>
        <th>Data</th>
        <th>Godzina</th>
        <th>Liczba miejsc</th>
        <th>Krótki opis wydarzenia</th>
        <th>Słowa kluczowe</th>
        <th>Platforma</th>
        <th>Wlasciciel</th>
        </tr>";
        
        foreach ($data as $row) 
        {
            $pole1=$row['Nazwa_webinaru'];
            $pole2=$row['Data_webinaru'];
            $pole3=$row['Godzina'];
            $pole4=$row['Liczba_miejsc'];
            $pole5=$row['Opis'];
            $pole6=$row['Tag'];
            $pole7=$row['Platforma'];
            $pole8=$row['Wlasciciel'];
            $p_lp++;
            
            echo "<tr><td>" . $pole1. "</td><td>" . $pole2. "</td><td>" . $pole3. "</td>
            <td>" . $pole4. "</td><td>" . $pole5. "</td><td>" . $pole6. "</td><td>" . $pole7 ."</td><td>" . $pole8 . "</td></tr>";
            
            //echo "<br>";
        }
        echo "</table>";
        $conn = null;
    }
      
    catch(PDOException $err) 
    {
      echo "Błąd połączenia z bazą: " . $err->getMessage();
    }
    ?>
        <a href=oferty.php><button class="buttonBack buttonBackBrowse">
                <p>Powrót</p>
            </button></a>
    </div>
    </div>
</body>

</html>