<!DOCTYPE html>
<html lang="en">
<?php
header('content-type: text/html; charset=utf-8');
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sandy | Redirection</title>
    <link rel="stylesheet" href="./style/style.css">
</head>

<body>
    <img src="./img/logo.svg" class="logo" alt="logo"><br><br>
    <div class="container">
        <?php
        if(isset($_GET["enregistre"])){
            if(($_GET["enregistre"])=="ok"){
                echo "<h2 class='content'>Votre audit a bien été enregistré, que souhaitez vous faire à présent ?</h2>";
            }
        }
        else{
            echo"<h2 class='content'>Que souhaitez vous faire à présent ?</h2>";
        }
        ?>

        <a href="./creation/creationAudit.php"><button class="btn-grad" name="new_audit">Créer un audit</button></a>
        <a href="./search/search.php?audit=modification"><button class="btn-grad" name="import_audit">Modifier un audit</button></a>
        <a href="./search/search.php?audit=realisation"><button class="btn-grad" name="import_audit">Réaliser un audit</button></a>
        <a href="./search/search.php?audit=edition"><button class="btn-grad" name="import_audit">Éditer un audit</button></a>
        <a href="./search/search.php?audit=document"><button class="btn-grad" name="import_docs">Mes Documents</button></a>
    </div>
</body>

</html>