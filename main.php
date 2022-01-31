<?php
session_start();
if(!isset($_SESSION['username'])){
header("Location: index.php");}
?>

<!DOCTYPE html>
<html lang="pl-PL">

<head>

  <meta charset="UTF-8">
  <title>Autoryzacja użytkowników</title>
<link rel="stylesheet" href="styles/styles.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital@1&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&display=swap" rel="stylesheet">  
  
</head>

<body>
<div class="mainWrapperMainMenu">

    <?php
    echo "<h1 style=\"padding:20px; border:2px solid #FAFAFA;text-align: center;\">Hello!"."<br>"."Your login: ".$_SESSION['username']."."."<br>"."You can add your review here.</h1>";

    ?>

    <section style="display: flex;
    justify-content: space-around;
    align-items: center;">
        <a href=oferty.php><button class="buttonBack buttonBackBrowse"><p>View reviews</p></button></a>
        <a href=dodawanie.php><button class="buttonBack buttonBackBrowse"><p>Add a review</p></button></a> 
        <a href=logout.php><button class="buttonBack buttonBackBrowse" style="background-color:red;box-shadow: 0px 0px 8px 0px rgba(255, 77, 122, 0.35);"><p>Log out</p></button></a>
    </section>
</div>
</body>

</html>