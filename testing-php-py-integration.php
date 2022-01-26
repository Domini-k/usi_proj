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

    <h1>Testing integration between Php and python</h1></br>

    <form action="" method="post">

        <input type="text" name="providedText" placeholder="Provide the text" />

        <input type="submit" name="submit" />
    </form>

    <?php

    if (isset($_POST['submit'])) {
        $input = $_POST['providedText'];
        file_put_contents('saved_input.json', json_encode($input));
        shell_exec('python predictions.py');
        $p = json_decode(file_get_contents('saved_prediction.json'));
        echo $p;
    } else {
        echo "provide the text";
    }
    echo "</br>" . "=============================================================" . "</br>" . "end of prediction process";
    ?>

</body>

</html>