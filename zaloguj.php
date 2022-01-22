<?php
session_start();
if(isset($_SESSION['username'])){
header("Location: main.php");
} else {
        require_once "baza_link.php";
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {
	$login = $_POST['login'];
        $haslo = $_POST['haslo'];
        
        $sql = "SELECT * FROM Users WHERE Login = '$login' AND Haslo = '$haslo'";
        $stmt = $conn->query($sql);
        $rows = $stmt->rowCount();
        
        if($rows == 1){
        header('Location: main.php');
        $_SESSION['username'] = $login; 
        }else if($stmt->rowCount() == 0){
        $_SESSION['login_error'] = "Użytkownik nie istnieje!";
        header("Location: index.php");
        } else{
        echo "Coś poszło nie tak!";
        }
        
    	$conn = null;
       }
    catch(PDOException $err) 
    {
    echo "Błąd: brak połączenia z bazą danych! " . $err->getMessage();
    }
}
?>