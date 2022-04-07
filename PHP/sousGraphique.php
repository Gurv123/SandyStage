<?php

session_start();

include ('Arbre.php');
include ('Noeud.php');
include ('Graph.php');

$noeud = new Noeud(null, false, "", "", "");
$racine = new Noeud(null, false, "", "", "");
$hauteur_graph = 0;

if($_GET['noeud'] == 999)
{
	$noeud = unserialize($_SESSION['racine']);
	$racine = $noeud->getPere();
}
else
{
	if($_GET['noeud'] == 1000)
	{
		$noeud = unserialize($_SESSION['graph_racine']);
		$racine = $noeud;
	}
	else
	{
		$noeud = unserialize($_SESSION['racine']);
		$racine = $noeud->getListeFils()[$_GET['noeud']];
	}
}

$titre = unserialize($_SESSION['titreGraphe']);

$arbre = new Arbre($racine);
$graphe = new Graph($arbre);

$graphe->graphNoeud($racine);

$rac = serialize($racine);
$_SESSION['racine'] = $rac;

$hauteur_graph = unserialize($_SESSION['hauteur_graph']);

$chaine1 = $graphe->getChaineNoeud1();
$chaine2 = $graphe->getChaineNoeud2();


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/jquery-ui.css">
    <link rel="stylesheet" href="../style/style.css">
    <!--<link rel="stylesheet" href="../style/jquery.treegrid.css">
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link rel="stylesheet" href="../style/redmond/jquery-ui-1.7.1.custom.css" />
    <link rel="stylesheet" href="../style/ui.slider.extras.css" />
    <link rel="stylesheet" href="../style/slider.css"> -->
    <title>Sandy | Graphique</title>
</head>

<body>
<script src="../Chart.js-2.9.4/dist/Chart.js"></script>
<div align="center"><table width=85% height=85%>
	<thead><h2 class="content">
				<?php 
				if($racine->getId() == 0)
				{
					echo "Titre: ".$titre."<br>Note = ".number_format($racine->getNote(),2)." / 5";
				}
				else
				{
					echo "Titre: ".$titre." / Chapitre : ".$racine->getId()."<br>Note = ".number_format($racine->getNote(),2)." / 5";
				}
				?>
	</h2></thead>				
	<tr>
		
		<td valign='top'>
			<?php 
			if($racine->hauteur()>2)
			{
				for($i=0; $i<count($racine->getListeFils()); $i++)
				{
					echo "<a href='sousGraphique.php?noeud=".$i."'><input type='button' class='btn-grad' value='Sous-graphique de ".$racine->getListeFils()[$i]->getId()."' style='width: 250px;'></a><br><br>";
					//echo "<a href='sousGraphique.php?noeud=".$i."'>Sous-graphique de ".$racine->getListeFils()[$i]->getId()."</a><br><br>";
				}
			}
			if($racine->hauteur() < $hauteur_graph )
			{
				echo "<b><a href='sousGraphique.php?noeud=999'><input type='button' class='btn-grad' value='Revenir en arrière' style='width: 250px;'></a></b><br><br>";
				echo "<b><a href='sousGraphique.php?noeud=1000'><input type='button' class='btn-grad' value='Graphique complet' style='width: 250px;'></a></b><br><br>";
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
            label: 'Note sur 5',
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

