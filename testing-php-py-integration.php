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

    <?php
        $input="This_is_text_from_php";
        $command = escapeshellcmd('python3 test.py '.$input);
        $output = exec($command);
        echo $output;
    ?>

</body>

</html>