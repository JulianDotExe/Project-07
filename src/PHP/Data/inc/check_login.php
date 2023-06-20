<?php
if (isset($_SESSION['uname'])) {
    echo "<script>location.href='./overzicht_gevangenen.php'</script>";
} else {
    $stmt = $pdo->prepare("SELECT * FROM personeel WHERE gebruikersnaam = :gebruikersnaam AND wachtwoord = :wachtwoord");
    $stmt->bindParam(':gebruikersnaam', $uname);
    $stmt->bindParam(':wachtwoord', $pwd);
    $stmt->execute();

    if($stmt->rowCount() == 1) {
        $_SESSION['gebruikersnaam'] = $uname;
        echo "<script>location.href='./overzicht_gevangenen.php'</script>";
    } else {
        echo "<script>alert('Inloggen mislukt...')</script>";
        echo "<script>location.href='./login.php'</script>";
    }
}
?>