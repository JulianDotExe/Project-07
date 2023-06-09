<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personeel toevoegen</title>

    <link rel="apple-touch-icon" sizes="180x180" href="../../../../img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../../../img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../../../img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../../../img/favicon/site.webmanifest">

    <link rel="stylesheet" href="../../../CSS/main.css">
    <link rel="stylesheet" href="../../../CSS/resize.css">
    
    <!-- External Scripts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <!-- External Scripts -->

</head>
<body>
    <div class="background backgroundLight"></div>

    <header>
        <div class="logo"></div>

        <div class="header">
            <i class="fa fa-solid fa-power-off fa-lg" style="color: #f67b50;"></i>
            <span id="tekstlog"> <a href="../logout.php"> Log out</a></span>
            <i class="fa fa-solid fa-x"></i>
        </div>
    </header>

    <?php
        require_once("../inc/db_conn.php");
        if (!isset($_SESSION['gebruikersnaam'])) {
            echo "<script>alert('Inloggen mislukt...')</script>";
            echo "<script>location.href='../login.php'</script>";
        }

        $stmt = $pdo->prepare("SELECT functie_id FROM personeel WHERE gebruikersnaam = :gebruikersnaam");
        $stmt->bindParam(':gebruikersnaam', $uname);
        $stmt->execute();
        $userRole = $stmt->fetchColumn();
    ?>

    <content>

        <div class="back">
            <i class="fa fa-solid fa-arrow-left fa-2x" style="color: #f67b50;"></i>
        </div>

        <div class="dataContainAdd">
            <form method="POST">
                <input type="text" class="form form2" name="id_personeel" placeholder="ID . . ." required><br>
                <input type="text" class="form form2" name="naam_personeel" placeholder="Volledige naam . . ." required><br>
                <input type="password" class="form form3" name="wachtwoord" placeholder="Wachtwoord . . ." required><br>
                <input type="text" class="form form4" name="gebruikersnaam" placeholder="Gebruikersnaam . . ." required><br>
                <input type="text" class="form form4" name="functie_id" placeholder="Functie ID. . ." required><br>
                <input type="text" class="form form4" name="email_personeel" placeholder="Email . . ." required><br>

                <input type="submit" name="terug" value="Terug" class="return">
                <input type="submit" name="submit" value="Submit" class="submit">           
            </form>

    <?php
        require_once("../inc/db_conn.php");

        if (isset($_POST['submit'])) {
            echo '<div id="confirm">Actie succesvol</div>';
            echo '<script>setTimeout(function(){
                document.getElementById("confirm").style.display = "none";
                window.location.href="../beheer/overzicht_personeel.php";
            }, 2000);</script>';

            $personeelid = $_POST['id_personeel'];
            $naam= $_POST['naam_personeel'];
            $wachtwoord = $_POST['wachtwoord'];
            $gebruikersnaam = $_POST['gebruikersnaam'];
            $functie = $_POST['functie_id'];
            $email_personeel = $_POST['email_personeel'];

            // Hash the password
            $pwHash = password_hash($wachtwoord, PASSWORD_BCRYPT);

            // // Display the original password and the hashed password (for testing purposes)
            // echo $wachtwoord . PHP_EOL;
            // echo $pwHash . PHP_EOL;

            // Save the hashed password to the database
            if (password_verify($wachtwoord, $pwHash)) {
                // echo 'Password is valid';
                // Store the $pwHash value in the 'wwhash' column of the 'personeel' table during the INSERT query
                $stmt = $pdo->prepare("INSERT INTO personeel (id_personeel, naam_personeel, gebruikersnaam, functie_id, email_personeel, wwhash) VALUES (:id_personeel, :naam_personeel, :gebruikersnaam, :functie_id, :email_personeel, :wwhash)");
                $stmt->execute([
                    ':id_personeel' => $personeelid,
                    ':naam_personeel' => $naam,
                    ':gebruikersnaam' => $gebruikersnaam,
                    ':functie_id' => $functie,
                    ':email_personeel' => $email_personeel,
                    ':wwhash' => $pwHash
                ]);
            } else {
                // echo 'Invalid password';
            }
        }
    ?>
      
        </div>
        
    </content>

    <script>
        $(".log").click(function() {
            location.replace("../logout.php")
        })

        $(".back").click(function() {
            location.replace("../beheer/overzicht_personeel.php")
        })

        $(".return").click(function () {
            location.replace("../beheer/overzicht_personeel.php")
        })
    </script>
</body>
</html>
