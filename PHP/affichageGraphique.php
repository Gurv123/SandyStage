<?php

session_start();

include ('Arbre.php');
include ('Noeud.php');
include ('Graph.php');



header('content-type: text/html; charset=utf-8');

$racine = new Noeud(null, false, "Audit-001", "Test premier audit", "../references/ref1.txt");

$noeud1 = new Noeud($racine, false, "Secu incendie", "Test premier audit", "../references/ref1.txt");
$noeud2 = new Noeud($racine, false, "Secu intrusion", "Test premier audit", "../references/ref2.txt");
$noeud3 = new Noeud($racine, false, "Secu info", "Test premier audit", "../references/ref3.txt");

$noeud4 = new Noeud($noeud1, false, "Secu incendie", "Test premier audit", "../references/ref1.txt");
$noeud5 = new Noeud($noeud1, false, "Secu intrusion", "Test premier audit", "../references/ref2.txt");
$noeud6 = new Noeud($noeud1, false, "Secu info", "Test premier audit", "../references/ref3.txt");

$noeud7 = new Noeud($noeud2, false, "Secu incendie", "Test premier audit", "../references/ref1.txt");
$noeud8 = new Noeud($noeud2, false, "Secu intrusion", "Test premier audit", "../references/ref2.txt");
$noeud9 = new Noeud($noeud2, false, "Secu info", "Test premier audit", "../references/ref3.txt");

$noeud10 = new Noeud($noeud3, false, "Secu incendie", "Test premier audit", "../references/ref1.txt");
$noeud11 = new Noeud($noeud3, false, "Secu intrusion", "Test premier audit", "../references/ref2.txt");
$noeud12 = new Noeud($noeud3, false, "Secu info", "Test premier audit", "../references/ref3.txt");

$noeud13 = new Noeud($noeud4, true, "Secu incendie", "Test premier audit", "../references/ref1.txt");
$noeud14 = new Noeud($noeud4, true, "Secu intrusion", "Test premier audit", "../references/ref2.txt");
$noeud15 = new Noeud($noeud4, true, "Secu info", "Test premier audit", "../references/ref3.txt");

$noeud16 = new Noeud($noeud5, true, "Secu incendie", "Test premier audit", "../references/ref1.txt");
$noeud17 = new Noeud($noeud5, true, "Secu intrusion", "Test premier audit", "../references/ref2.txt");
$noeud18 = new Noeud($noeud5, true, "Secu info", "Test premier audit", "../references/ref3.txt");

$noeud19 = new Noeud($noeud6, true, "Secu incendie", "Test premier audit", "../references/ref1.txt");
$noeud20 = new Noeud($noeud6, true, "Secu intrusion", "Test premier audit", "../references/ref2.txt");
$noeud21 = new Noeud($noeud6, true, "Secu info", "Test premier audit", "../references/ref3.txt");

$noeud22 = new Noeud($noeud7, true, "Secu incendie", "Test premier audit", "../references/ref1.txt");
$noeud23 = new Noeud($noeud7, true, "Secu intrusion", "Test premier audit", "../references/ref2.txt");
$noeud24 = new Noeud($noeud7, true, "Secu info", "Test premier audit", "../references/ref3.txt");

$noeud25 = new Noeud($noeud8, true, "Secu incendie", "Test premier audit", "../references/ref1.txt");
$noeud26 = new Noeud($noeud8, true, "Secu intrusion", "Test premier audit", "../references/ref2.txt");
$noeud27 = new Noeud($noeud8, true, "Secu info", "Test premier audit", "../references/ref3.txt");

$noeud28 = new Noeud($noeud9, true, "Secu incendie", "Test premier audit", "../references/ref1.txt");
$noeud29 = new Noeud($noeud9, true, "Secu intrusion", "Test premier audit", "../references/ref2.txt");
$noeud30 = new Noeud($noeud9, true, "Secu info", "Test premier audit", "../references/ref3.txt");

$noeud31 = new Noeud($noeud10, true, "Secu incendie", "Test premier audit", "../references/ref1.txt");
$noeud32 = new Noeud($noeud10, true, "Secu intrusion", "Test premier audit", "../references/ref2.txt");
$noeud33 = new Noeud($noeud10, true, "Secu info", "Test premier audit", "../references/ref3.txt");

$noeud34 = new Noeud($noeud11, true, "Secu incendie", "Test premier audit", "../references/ref1.txt");
$noeud35 = new Noeud($noeud11, true, "Secu intrusion", "Test premier audit", "../references/ref2.txt");
$noeud36 = new Noeud($noeud11, true, "Secu info", "Test premier audit", "../references/ref3.txt");

$noeud37 = new Noeud($noeud12, true, "Secu incendie", "Test premier audit", "../references/ref1.txt");
$noeud38 = new Noeud($noeud12, true, "Secu intrusion", "Test premier audit", "../references/ref2.txt");
$noeud39 = new Noeud($noeud12, true, "Secu info", "Test premier audit", "../references/ref3.txt");

$arbre = new Arbre($racine);
$arbre->ajouterNoeud($noeud1);
$arbre->ajouterNoeud($noeud2);
$arbre->ajouterNoeud($noeud3);
$arbre->ajouterNoeud($noeud4);
$arbre->ajouterNoeud($noeud5);
$arbre->ajouterNoeud($noeud6);
$arbre->ajouterNoeud($noeud7);
$arbre->ajouterNoeud($noeud8);
$arbre->ajouterNoeud($noeud9);
$arbre->ajouterNoeud($noeud10);
$arbre->ajouterNoeud($noeud11);
$arbre->ajouterNoeud($noeud12);
$arbre->ajouterNoeud($noeud13);
$arbre->ajouterNoeud($noeud14);
$arbre->ajouterNoeud($noeud15);
$arbre->ajouterNoeud($noeud16);
$arbre->ajouterNoeud($noeud17);
$arbre->ajouterNoeud($noeud18);
$arbre->ajouterNoeud($noeud19);
$arbre->ajouterNoeud($noeud20);
$arbre->ajouterNoeud($noeud21);
$arbre->ajouterNoeud($noeud22);
$arbre->ajouterNoeud($noeud23);
$arbre->ajouterNoeud($noeud24);
$arbre->ajouterNoeud($noeud25);
$arbre->ajouterNoeud($noeud26);
$arbre->ajouterNoeud($noeud27);
$arbre->ajouterNoeud($noeud28);
$arbre->ajouterNoeud($noeud29);
$arbre->ajouterNoeud($noeud30);
$arbre->ajouterNoeud($noeud31);
$arbre->ajouterNoeud($noeud32);
$arbre->ajouterNoeud($noeud33);
$arbre->ajouterNoeud($noeud34);
$arbre->ajouterNoeud($noeud35);
$arbre->ajouterNoeud($noeud36);
$arbre->ajouterNoeud($noeud37);
$arbre->ajouterNoeud($noeud38);
$arbre->ajouterNoeud($noeud39);

$noeud1->setNote(2);
$noeud2->setNote(2);
$noeud3->setNote(2);
$noeud4->setNote(2);
$noeud5->setNote(2);
$noeud6->setNote(2);
$noeud7->setNote(2);
$noeud8->setNote(2);
$noeud9->setNote(2);
$noeud10->setNote(2);
$noeud11->setNote(2);
$noeud12->setNote(2);
$noeud13->setNote(2);
$noeud14->setNote(2);
$noeud15->setNote(2);
$noeud16->setNote(2);
$noeud17->setNote(2);
$noeud18->setNote(2);
$noeud19->setNote(2);
$noeud20->setNote(2);
$noeud21->setNote(2);
$noeud22->setNote(2);
$noeud23->setNote(2);
$noeud24->setNote(2);
$noeud25->setNote(2);
$noeud26->setNote(2);
$noeud27->setNote(2);
$noeud28->setNote(2);
$noeud29->setNote(2);
$noeud30->setNote(2);
$noeud31->setNote(2);
$noeud32->setNote(2);
$noeud33->setNote(2);
$noeud34->setNote(2);
$noeud35->setNote(2);
$noeud36->setNote(2);
$noeud37->setNote(2);
$noeud38->setNote(2);
$noeud39->setNote(2);


$graphique = new Graph($arbre);

$hauteur_graph = serialize($racine->hauteur());
$_SESSION['hauteur_graph'] = $hauteur_graph;

$graph_racine = serialize($racine);
$_SESSION['graph_racine'] = $graph_racine;

$noeud = serialize($racine);
$_SESSION['racine'] = $noeud;

$graphique->graphNoeud($graphique->getArbre()->getRacine()->getListeFils()[0]);

$result = array();
$position = -1;
$racine->getSousArbre($result, $position);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/jquery-ui.css">
    <link rel="stylesheet" href="../style/style.css">-->
    <!--<link rel="stylesheet" href="../style/jquery.treegrid.css">
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link rel="stylesheet" href="../style/redmond/jquery-ui-1.7.1.custom.css" />
    <link rel="stylesheet" href="../style/ui.slider.extras.css" />
    <link rel="stylesheet" href="../style/slider.css"> -->
    <title>Sandy | Graphique</title>
</head>

<body>
<script src="../Chart.js-2.9.4/dist/Chart.js"></script>
<div align="center"><table width="501" height="501">
	<tr><td>
			<?php 
			for($i=0; $i<count($graphique->getArbre()->getRacine()->getListeFils()); $i++)
			{
				echo "<a href='sousGraphique.php?noeud=".$i."'>Sous-graphique de ".$graphique->getArbre()->getRacine()->getListeFils()[$i]->getId()."</a><br><br>";
			}
			?>
		</td>
		<td><canvas id="myChart" width="500" height="500"></canvas></td>
	</tr>
</table></div>
<script>
var ctx = document.getElementById('myChart');

var myChart = new Chart(ctx, {
    type: 'radar',
    data: {
		labels: <?php echo $graphique->getChaine1(); ?>,
        datasets: [{
            label: 'Note sur 5',
			data: <?php echo $graphique->getChaine2(); ?>,
			
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

