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
    echo "<h1 style=\"padding:20px; border:2px solid #FAFAFA;text-align: center;\">"."Hello ". $_SESSION['username'] . "!"."</h1>";
  } else {
    echo "<h1 style=\"padding:20px; border:2px solid #FAFAFA;text-align: center;\">Login to add a review"."<br>"."You can only view the reviews</h1>";}
  ?>
    <?php
    
    try {
        require_once "baza_link.php";
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo 'Poprawne połączenie z bazą <br>';
        
        
        $data = $conn->query(" SELECT`Tytul`, `Tresc`, `Ocena`, `Data_dod` FROM `recenzje` ORDER BY Data_dod")->fetchAll();
        $p_lp=0;
        
        echo "<table border=3>
        <tr>
        <th>Title</th>
        <th>Review</th>
        <th>Rating</th>
		<th>Data_dod</th>
		</tr>";
        
        foreach ($data as $row) 
        {
            $pole1=$row['Tytul'];
            $pole2=$row['Tresc'];
            $pole3=$row['Ocena'];
            $pole4=$row['Data_dod'];
            $p_lp++;
            
            echo "<tr><td>" . $pole1. "</td><td>" . $pole2. "</td><td>" . $pole3. "</td>
            <td>" . $pole4. "</td></tr>";
            
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
    <a href=main.php><button class="buttonBack buttonBackBrowse"><p>Main page</p></button></a>
</div>
</div>
</body>
</html>


