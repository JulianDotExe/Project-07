<?php

require_once("inc/db_conn.php");

$uname = $_POST['uname'];
$pwd = $_POST['pwd'];

session_start();

if (isset($_SESSION['uname'])) {
    echo "<script>location.href='overzicht.php'</script>";
} else {
    $stmt = $pdo->prepare("SELECT * FROM personeel WHERE gebruikersnaam = :gebruikersnaam AND wachtwoord = :wachtwoord");
    $stmt->bindParam(':gebruikersnaam', $uname);
    $stmt->bindParam(':wachtwoord', $pwd);
    $stmt->execute();

    if($stmt->rowCount() == 1) {
        $_SESSION['uname'] = $uname;
        echo "<script>location.href='overzicht.php'</script>";
    } else {
        echo "<script>location.href='failed.php'</script>";
        echo "<script>setTimeout(() => {
            location.href='login.php'
                  }, 1000)</script>";
    }
}
?>