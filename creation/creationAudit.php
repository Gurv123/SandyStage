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
    <img src="../img/logo.svg" class="logo" alt="logo">
    <div class="container">
        <h2 class="content">Vous pouvez créer un audit depuis Sandy ou téléverser un audit.</h2>

        <form action="" method="post" class="content">
            <div class="content">Pour créer un audit depuis Sandy, saisir le nom à donner à votre audit : <input type="text" name="audit_name" id="audit_name"></div>
            <input type="submit" class="btn-grad" value="Valider">
        </form>

        <?php
        if(isset($_POST) && !empty($_POST)){
            $search = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ');
	        $replace = array('A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y');
	        $nameFile = str_replace($search, $replace, $_POST['audit_name']);

	        $pathFileName = './audits_creation/audit_'. str_replace(" ", "", $nameFile) .'.json';

            if (file_exists($pathFileName)) {
                echo "Vous avez déjà un fichier d'audit comportant ce nom. Veuillez changez de nom. <br><br>";
            } else {
                $_SESSION['name'] = $_POST['audit_name'];

                header('Location:../creation/creation.php?default');;
            }
        }            
        ?>

		<div class="content">Téléverser un audit préparé au format .csv ou .xml <a href="./aideImport.php"><input type="button" class="btn-grad" value="Aide import" style="width:120px; height:25px;"></a></div>
        
        <a href="../PHP/importAudit.php"><input type="button" class="btn-grad" value="Téléverser un audit" style="width: 300px;"></a>
		
        <a href="../index.php"><input type="button" class="btn-grad" value="Retour au menu" style="width: 200px;"></a>
	</div>
</body>
</html>