<?php
    session_start();
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
    <img src="./img/logo.svg" class="logo" alt="logo">
    <div class="container">
        <h2 class="content">Bienvenue sur le portail Sandy.</h2>
		<h3 class="content">Plateforme de création, modification et édition d'audits en ligne.</h3>       
        <!--<form action="" method="post" class="content">
            <div class="content">Veuillez saisir le nom que vous souhaitez donner à votre audit : <input type="text" name="audit_name" id="audit_name"></div>
            <br><br>
            <input type="submit" class="btn-grad" value="Valider">
        </form>-->
		
        <a href="./search/search.php?audit=creation"><button class="btn-grad-menu">Créer un audit</button></a>
        
        <a href="./search/search.php?audit=modification"><button class="btn-grad-menu">Modifier un audit</button></a>
        
        <a href="./search/search.php?audit=realisation"><button class="btn-grad-menu">Réaliser un audit</button></a>
		
        <a href="./search/search.php?audit=edition"><button class="btn-grad-menu">Éditer un audit</button></a>
		
        <a href="./search/search.php?audit=document"><button class="btn-grad-menu">Mes documents</button></a>
    </div>
    
</body>

    <?php
        if(isset($_POST) && !empty($_POST)){
            $_SESSION['name'] = $_POST['audit_name'];
            header('Location:./creation/creation.php?default');
        }            
    ?>
</html>