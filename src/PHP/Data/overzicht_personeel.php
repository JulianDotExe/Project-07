<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overzicht</title>
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

    <?php
        require_once("inc/db_conn.php");
        if (!isset($_SESSION['uname'])) {
            echo "<script>alert('Inloggen mislukt...')</script>";
            echo "<script>location.href='login.php'</script>";
        }

        $stmt = $pdo->prepare("SELECT functie FROM personeel WHERE gebruikersnaam = :gebruikersnaam");
        $stmt->bindParam(':gebruikersnaam', $uname);
        $stmt->execute();
        $userRole = $stmt->fetchColumn();
    ?>

    <content>
        <div class="back">
            <i class="fa fa-solid fa-arrow-left fa-2x" style="color: #f67b50;"></i>
        </div>

        <div class="dataContain dataCenter">
        <table class="table">
            <tr>
                <?php 
                switch($userRole) {
                    case 'Bewaker':
                        echo "  <th>ID</th>
                                <th id='optional'>Naam</th>
                                <th>Wachtwoord</th>
                                <th>Gebruikersnaam</th>
                                <th>Functie</th>
                                <th id='optional'>Actie</th>";
                    break;
                    default:
                        echo "  <th>ID</th>
                                <th id='optional'>Naam</th>
                                <th>Wachtwoord</th>
                                <th>Gebruikersnaam</th>
                                <th>Functie</th>
                                <th id='optional'>Actie</th>";
                    break;
                }
                ?>
            </tr>
            <?php
            $sql="SELECT * FROM personeel";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                switch($userRole) {
                    case 'Bewaker':
                        echo "<td>".$row['personeel_id']."</td>
                            <td id='optional'>".$row['naam']."</td>
                            <td>".$row['wachtwoord']."</td>
                            <td>".$row['gebruikersnaam']."</td>
                            <td>".$row['functie']."</td>
                            <td id='optional'>
                                <a href='edit/gegevens_edit_personeel.php?id={$row['personeel_id']}' class='btn-edit'><i class='material-icons md-24'>edit</i></a>
                                <a href='delete/gegevens_del_personeel.php?id={$row['personeel_id']}' class='btn-delete'><i class='material-icons md-10'>delete</i></a>
                            </td>";
                    break;
                    case 'Coordinator':
                        echo "<td>".$row['personeel_id']."</td>
                            <td id='optional'>".$row['naam']."</td>
                            <td>".$row['wachtwoord']."</td>
                            <td>".$row['gebruikersnaam']."</td>
                            <td>".$row['functie']."</td>
                            <td id='optional'>
                                <a href='edit/gegevens_edit_personeel.php?id={$row['personeel_id']}' class='btn-edit'><i class='material-icons md-24'>edit</i></a>
                                <a href='delete/gegevens_del_personeel.php?id={$row['personeel_id']}' class='btn-delete'><i class='material-icons md-10'>delete</i></a>
                            </td>";
                    break;
                    default:
                        echo "<td>".$row['personeel_id']."</td>
                            <td id='optional'>".$row['naam']."</td>
                            <td>".$row['wachtwoord']."</td>
                            <td>".$row['gebruikersnaam']."</td>
                            <td>".$row['functie']."</td>
                            <td id='optional'>
                                <a href='edit/gegevens_edit_personeel.php?id={$row['personeel_id']}' class='btn-edit'><i class='material-icons md-24'>edit</i></a>
                                <a href='delete/gegevens_del_personeel.php?id={$row['personeel_id']}' class='btn-delete'><i class='material-icons md-10'>delete</i></a>
                            </td>";
                    break;
                }
                echo "</tr>";
            }
            ?>
        </table>
        </div>
    </content>

    <script>
        $(".log").click(function() {
            location.replace("./logout.php")
        })
        
        $(".back").click(function() {
            location.replace("./indexdb.php")
        })
    </script>
</body>
</html>