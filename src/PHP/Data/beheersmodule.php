<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beheersmodule</title>

    <link rel="apple-touch-icon" sizes="180x180" href="../../../img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../../img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../../img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../../img/favicon/site.webmanifest">

    <link rel="stylesheet" href="../../CSS/main.css">
    <link rel="stylesheet" href="../../CSS/resize.css">
    
    <!-- External Scripts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <!-- External Scripts -->

</head>
<body>

<?php
        require_once("inc/db_conn.php");
        if (!isset($_SESSION['gebruikersnaam'])) {
            echo "<script>alert('Inloggen mislukt...')</script>";
            echo "<script>location.href='login.php'</script>";
        }

        require_once("class/permission_class.php");

        $pageTitle = "Beheermodule";
        $emailUser = $_SESSION['gebruikersnaam'];
    
        $objCheckRecht = new Permission($pdo);
        $CheckRecht = $objCheckRecht->CheckPagePermission($pageTitle, $emailUser);

        $stmt = $pdo->prepare("SELECT functie_id FROM personeel WHERE gebruikersnaam = :gebruikersnaam");
        $stmt->bindParam(':gebruikersnaam', $emailUser);
        $stmt->execute();
        $userRole = $stmt->fetchColumn();
    ?>

    <div class="background backgroundLight"></div>
    <header>
        <div class="logo"></div>

        <div class="header">
            <i class="fa fa-solid fa-power-off fa-lg log" style="color: #f67b50;"></i>
            <span id="tekstlog" class="log"> <a href="logout.php"> Log out</a></span><br><br>
            <i class="fa fa-solid fa-gear fa-lg bh" style="color: #f67b3c;"></i>
            <span id="tekstlog"> <a href="indexdb.php"> Leave beheer</a></span>
            <i class="fa fa-solid fa-x"></i>
        </div>
    </header>

    <content>
       <div class="beheerContain">
        <span class="menuTitle">Beheersmodule <i class="fa fa-solid fa-gears" style="color: #000000;"></i></span>
             <button class="btnStyle btn3"> <a href="beheer/overzicht_personeel.php"> Overzicht - Personeel</a></button>
             <button class="btnStyle btn5"> <a href="beheer/overzicht_functie.php"> Overzicht - Functies </a></button>
             <button class="btnStyle btn4"> <a href="beheer/permissies.php"> Permissies - Functies </a></button>
        </div>
    </content>


    <footer>
        <div class="warning"></div>
    </footer>

    <script>
        $(".log").click(function() {
            location.replace("./logout.php")
        })

        $(".bh").click(function() {
            location.replace("indexdb.php")
        })

        $(".btn3").click(function () {
            location.replace("beheer/overzicht_personeel.php")
        })
        
        $(".btn4").click(function () {
            location.replace("beheer/permissies.php")
        })
        
        $(".btn5").click(function () {
            location.replace("beheer/overzicht_functie.php")
        })
    </script>
</body>
</html>