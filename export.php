<?php
header('content-type: text/html; charset=utf-8');
session_start();

if(isset($_GET['audit'])){
  $json_d = $_GET['jsondata'];
	$json_data = json_decode($json_d);
	$nameInit = $json_data[0]->init; // Permet de récupérer le texte de la key 'init' de l'id 0 (soit celui de la racine);

	$search = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ');
	$replace = array('A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y');
	$nameFile = str_replace($search, $replace, $nameInit);
	// Ici on enlève tout les accents de $nameInit

	$pathFileName = './'.$_GET['audit'] .'/audits_'.$_GET['audit'] .'/audit_'. str_replace(" ", "", $nameFile) .'.json'; //ici on enlève les espaces de $nameInit et on en fait le nom du fichier de que l'on va créer ou modifier

  file_put_contents($pathFileName, $json_d);
	header("Location:./redirect.php?enregistre=ok");
	Exit();
}
