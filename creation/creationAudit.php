<!DOCTYPE html>
<html lang="fr">
    <?php
        session_start();
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SANDY | Audit Tool</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>    
    <img src="../img/logo.svg" class="logo" alt="logo"><br><br>
    <div class="container">
        <h2 class="content">Vous pouvez créer un audit depuis Sandy ou téléverser un audit.</h2><br><br>       
        <form action="" method="post" class="content">
            <div class="content">Pour créer un audit depuis Sandy, saisir le nom à donner à votre audit : <input type="text" name="audit_name" id="audit_name"></div>
            <br>
            <input type="submit" class="btn-grad" value="Valider">
        </form>
		<br><br><br>
		<div class="content">Téléverser un audit préparé au format .csv ou .xml <a href="./aideImport.php"><input type="button" class="btn-grad" value="Aide import" style="width:120px; height:25px;"></a></div>
		<br>
        <a href="../PHP/importAudit.php"><input type="button" class="btn-grad" value="Téléverser un audit" style="width: 300px;"></a>
		<br><br>
		<br><br>
        <a href="../index.php"><input type="button" class="btn-grad" value="Retour au menu" style="width: 200px;"></a>
		<br><br>
	</div>
    
</body>

    <?php
        if(isset($_POST) && !empty($_POST)){
            $_SESSION['name'] = $_POST['audit_name'];
            header('Location:../creation/creation.php?default');
        }            
    ?>
</html>