<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beheersmodule</title>
    <link rel="stylesheet" href="../../CSS/main.css">
    <link rel="stylesheet" href="../../CSS/resize.css">
    
    <!-- External Scripts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <!-- External Scripts -->

</head>
<body>
    <div class="background backgroundLight"></div>

    <header>
        <div class="logo"></div>

        <div class="log">
            <i class="fa fa-solid fa-power-off fa-lg" style="color: #f67b50;"></i>
            <span id="tekstlog"> <a href="logout.php"> Log out</a></span>
            <i class="fa fa-solid fa-x"></i>
        </div>
    </header>

    <content>
       <div class="menuContain">
        <span class="menuTitle"> Beheersmodule </span>
             <button class="btnStyle btn3"> <a href="add/gegevens_add_personeel.php"> Toevoegen - Personeel</a></button>
             <button class="btnStyle btn4"> <a href="beheer/permissies.php"> Permissies - Personeel </a></button>
             <button class="btnStyle btn5"> <a href="beheer/overzicht_functie.php"> Overzicht - Functies </a></button>
             <button class="btnStyle btn6"> <a href="indexdb.php"><i class="fa fa-solid fa-arrow-left" style="color: #000;"></i> Verlaat Beheersmodule</a></button>
        </div>
    </content>

    <script>
        $(".log").click(function() {
            location.replace("./logout.php")
        })

        $(".btn3").click(function () {
            location.replace("add/gegevens_add_personeel.php")
        })
        
        $(".btn4").click(function () {
            location.replace("beheer/permissies.php")
        })
        
        $(".btn5").click(function () {
            location.replace("beheer/overzicht_functie.php")
        })

        $(".btn6").click(function () {
            location.replace("indexdb.php")
        })
    </script>
</body>
</html>