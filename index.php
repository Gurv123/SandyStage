<?php
        session_start();
        $_SESSION['name'] = '';
    ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SANDY | Audit Tool</title>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>    
    <img src="./img/logo.svg" class="logo" alt="logo"><br><br>
    <div class="container">
        <h2 class="content">Bienvenue sur le portail Sandy.</h2>
		<h3 class="content">Plateforme de création, modification et édition d'audits en ligne.</h3><br>       
        <!--<form action="" method="post" class="content">
            <div class="content">Veuillez saisir le nom que vous souhaitez donner à votre audit : <input type="text" name="audit_name" id="audit_name"></div>
            <br><br>
            <input type="submit" class="btn-grad" value="Valider">
        </form>-->
		<br>
        <a href="./search/search.php?audit=creation"><input type="button" class="btn-grad" value="Créer un audit" style="width: 300px;"></a>
        <br><br>
        <a href="./search/search.php?audit=modification"><input type="button" class="btn-grad" value="Modifier un audit" style="width: 300px;"></a>
        <br><br>
        <a href="./search/search.php?audit=realisation"><input type="button" class="btn-grad" value="Réaliser un audit" style="width: 300px;"></a>
		<br><br>
        <a href="./search/search.php?audit=edition"><input type="button" class="btn-grad" value="Éditer un audit" style="width: 300px;"></a>
		<br><br>
    </div>
    
</body>

    <?php
        if(isset($_POST) && !empty($_POST)){
            $_SESSION['name'] = $_POST['audit_name'];
            header('Location:./creation/creation.php?default');
        }            
    ?>
</html>