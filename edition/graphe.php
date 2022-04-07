<?php
//header('content-type: text/html; charset=utf-8');
session_start();

include ('../PHP/Arbre.php');
include ('../PHP/Noeud.php');
include ('../PHP/Graph.php');



if (isset($_POST['audit'])) {
    $jsonhref = "./audits_edition/" . $_POST['audit'];
    $json = file_get_contents($jsonhref);
    $json_d = json_decode($json);
    
	$titre = $json_d[0]->init;
	$racine = new Noeud(null, false, "", "", "");
	$noeudPere = new Noeud(null, false, "", "", "");
	$arbre = new Arbre($racine);
	$longTemp; //longueur id
	$long; //longueur id suivant

	//construction de l'arbre
	for($i = 0; $i < count($json_d); $i++) 
	{ 
		
		if($i == 0)
		{
			$racine->setTitre($json_d[0]->init);
			$racine->setDescription($json_d[0]->desc);
			$racine->setReference($json_d[0]->has);
			$racine->setNote($json_d[0]->note);
			$tit = serialize($racine->getTitre());
			$_SESSION['titreGraphe'] = $tit;
			$noeudPere = $racine;
			$longTemp = 1;
		}
		else
		{       
			$type = $json_d[$i]->type;
			$id = $json_d[$i]->id;
			$init = $json_d[$i]->init;
			$desc = $json_d[$i]->desc;
			$has = $json_d[$i]->has;
			$note = $json_d[$i]->note;
			$longTemp = strlen($json_d[$i]->id);
			
			$feuille = false;
			if($type == 'item')
			{
				$feuille = true;
			}
			
			$noeud = new Noeud($noeudPere, $feuille, $init, $desc, $has);
					
			if($i < count($json_d) - 1)
			{
				$long = strlen($json_d[$i+1]->id);
				
				if($long == 1)
				{
					$noeudPere = $racine;
					$longTemp = $long;
				}
				
				if(($long > $longTemp) && ($noeud->getFeuille() == false))
				{
					$noeudPere = $noeud;
					$longTemp = $long;
				}
				
				if($longTemp > $long && $longTemp > 1)
				{
					$tour = ($longTemp - $long) / 2;
					
					for($j=0; $j<$tour; $j++)
					{
						$noeudPere = $noeudPere->getPere();
					}
					$longTemp = $long;
				}
			}
			
			
			if($noeud->getFeuille())
			{
				$noeud->setNote($note);
			}			
			
			$arbre->ajouterNoeud($noeud);
			
		}					
	}
	//donne les notes aux noeuds internes
	$racine->parcoursPostfixe();

	$graph = new Graph($arbre);
	
	$hauteur_graph = serialize($racine->hauteur());
	$_SESSION['hauteur_graph'] = $hauteur_graph;

	$graph_racine = serialize($racine);
	$_SESSION['graph_racine'] = $graph_racine;

	$noeud = serialize($racine);
	$_SESSION['racine'] = $noeud;

	$chaine1 = $graph->getChaine1();
	$chaine2 = $graph->getChaine2();
}
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../style/jquery-ui.css">
		<link rel="stylesheet" href="../style/style.css">
		<link rel="stylesheet" href="../style/jquery.treegrid.css">
		<link rel="stylesheet" href="../style/bootstrap.min.css">
		<link rel="stylesheet" href="../style/redmond/jquery-ui-1.7.1.custom.css" />
		<link rel="stylesheet" href="../style/ui.slider.extras.css" />
		<link rel="stylesheet" href="../style/slider.css">
		<title>Sandy | Graphique</title>
	</head>

	<body>
	<script src="../Chart.js-2.9.4/dist/Chart.js"></script>
	<div align="center"><table width=85% height=85%>
		<thead><h2 class="content"><?php echo "Titre: ".$titre."<br>Note = ".number_format($racine->getNote(),2)." / 5";?></h2></thead>
		<tr>
			
			<td valign='top'>
			<?php 
			for($i=0; $i<count($graph->getArbre()->getRacine()->getListeFils()); $i++)
			{
				echo "<a href='../PHP/sousGraphique.php?noeud=".$i."'><input type='button' class='btn-grad' value='Sous-graphique de ".$graph->getArbre()->getRacine()->getListeFils()[$i]->getId()."' style='width: 250px;'></a><br><br>";
				//echo "<a href='../PHP/sousGraphique.php?noeud=".$i."'>Sous-graphique de ".$graph->getArbre()->getRacine()->getListeFils()[$i]->getId()."</a><br><br>";
			}
			?>
		<br><br>
        <a href="../index.php"><input type="button" class="btn-grad" value="Retour au menu" style="width: 200px;"></a>
		</td>
			<td valign='top'><canvas id="myChart" width="500" height="500"></canvas></td>
			<td width=250 align='left' valign='top'><?php $arbre->parcoursSommaire(); ?></td>
		</tr>
	</table></div>
	<script>
	var ctx = document.getElementById('myChart');

	var myChart = new Chart(ctx, {
		type: 'radar',
		data: {
			labels: <?php echo $chaine1; ?>,
			datasets: [{
				label: '# of Votes',
				data: <?php echo $chaine2; ?>,
				
				backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)'
				],
				borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)'
				],
				borderWidth: 1
			}]
		},
		options: {
			scale: {
				ticks: {
					beginAtZero: true,
					max: 5,
					min: 0,
					stepSize: 0.5
				}
			}
		}
	   
	});
	</script>
	</body>
	<footer>
	<script src="../scripts/jquery-1.12.4.js"></script>
		<script src="../scripts/jquery-ui-1.12.1.js"></script>
		<script src="../scripts/jquery.treegrid.custom.js"></script>
		<script src="../scripts/selectToUISlider.jQuery.js"></script>
		<script src="../scripts/bootstrap.bundle.min.js"></script>
		<script src="../scripts/sandy.js"></script>
		<script src="../scripts/slider.js"></script>
		<script src="../scripts/export_edition.js"></script>   
	</footer>

</html> 

