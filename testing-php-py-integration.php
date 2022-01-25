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
    $input = "This is text from php";
    $encoded64Input = base64_encode($input);
    $command = escapeshellcmd("python3 D:\Programy\PHP - XAMPP\htdocs\usi_proj\predictions.py");
    $output = exec($command);
    echo "before" . "</br>";
    echo shell_exec("python3 predictions.py");
    echo "after" . "</br>";
    ?>

</body>

</html>