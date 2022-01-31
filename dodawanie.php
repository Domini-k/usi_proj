<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
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
        <h1>Write your review here</h1>
        <form action="" method="post" class="addForm">
            <div class="listElement">
                <label for="nazwa">Movie title: </label>
                <input class="textInput" type="text" name="title" size=30 maxsize=3 />
            </div>
            <div class="listElement">
                <label for="data">Add your review:</label>
                <input class="textInput" type="text" name="review" size=30 maxsize=3 />
            </div>
            <div class="buttonMenu">
                <input type="submit" name="akcja" value="Add" class="button" />
                <input type="submit" name="akcja" value="Delete" class="button" />
            </div>
        </form>
        <a href=main.php><button class="button">
                <p>Main page</p>
            </button></a>
    </div>

    <?php
    if (isset($_POST['akcja'])) {
        $akcja = $_POST['akcja'];


        if (!empty($_POST['title']) && !empty($_POST['review']) && $akcja == "Add") {

            $title = $_POST['title'];
            $review = $_POST['review'];
            $data = date("Y-m-d");


            try {

                file_put_contents('saved_input.json', json_encode($review));
                shell_exec('python predictions.py');
                $rating = json_decode(file_get_contents('saved_prediction.json'));


                require_once "baza_link.php";
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "INSERT INTO `recenzje`(`Tytul`, `Tresc`, `Ocena`, `Data_dod`)
            VALUES ('$title',('$review'),'$rating','$data')";

                $conn->exec($sql);
                echo 'Your review is added! Degree of positivity: ';
                echo $rating;
                $conn = null;
            } catch (PDOException $err) {
                echo "Błąd połączenia z bazą: " . $err->getMessage();
            }
        } else if ($akcja == "Porzuć") {
            $_POST = array();
        } else if ($akcja == "Dodaj") {
            echo "Fill in all the fields!";
        }
    }
    ?>
</body>

</html>