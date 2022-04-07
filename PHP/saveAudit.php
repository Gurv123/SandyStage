<html>
<head>
  <meta charset="utf-8">
</head>
<body>
<?php
use SimpleExcel\SimpleExcel;

require_once('./faisalman-simple-excel-php-ea5326d/src/SimpleExcel/SimpleExcel.php'); // load the main class file (if you're not using autoloader)

$excel;
$nomOrigine = $_FILES['monfichier']['name'];
$elementsChemin = pathinfo($nomOrigine);
$extensionFichier = $elementsChemin['extension'];
$extensionsAutorisees = array("csv", "xml");


if (!(in_array($extensionFichier, $extensionsAutorisees))) 
{
    echo "Le fichier n'a pas l'extension attendue";
} 
else 
{  
    // Copie dans le repertoire du script avec un nom
    // incluant l'heure a la seconde pres 
    $repertoireDestination = dirname(__FILE__)."/";
    $nomDestination = "auditTeleverse".date("YmdHis").".".$extensionFichier;
	
    if (move_uploaded_file($_FILES["monfichier"]["tmp_name"],$repertoireDestination.$nomDestination)) 
	{
        /*echo "Le fichier temporaire ".$_FILES["monfichier"]["tmp_name"].
                " a été déplacé vers ".$repertoireDestination.$nomDestination;*/
		if($extensionFichier == 'csv')
		{
			$excel = new SimpleExcel('csv');
			$excel->parser->loadFile($nomDestination);
		}
		else
		{
			$excel = new SimpleExcel('xml');                    
			$excel->parser->loadFile($nomDestination); 
		}
		$excel->convertTo('json');		
		$fichier="../creation/audits_creation/audit_" . date("d-m-Y") .".json";
		$ouvre_fich=fopen($fichier,"w");
		fwrite($ouvre_fich,$excel->writer->saveString());
		fclose($ouvre_fich);
		unlink($nomDestination);
		header('Status: 301 Moved Permanently', false, 301);      
		header('Location: ../search/search.php?audit=realisation');      
		exit();
    }
	else 
	{
        echo "Le fichier n'a pas été uploadé (trop gros ?) ou ".
                "Le déplacement du fichier temporaire a échoué".
                " vérifiez l'existence du répertoire ".$repertoireDestination;
    }
}
?>
</body>
</html>