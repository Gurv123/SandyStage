<!--<!DOCTYPE html>
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
    <title>Sandy | Réalisation</title>
</head>

<body>
-->

<?php
include ("../jpgraph/jpgraph.php");
include ("../jpgraph/jpgraph_radar.php");
include ("../jpgraph/jpgraph_log.php");

// initialiser le tableau
$tab_notes = array();
$descItems = array('JAN', 'FEV', 'MAR', 'AVR', 'MAI', 'JUI', 'JUL', 'AOU', 'SEP', 'OCT', 'NOV', 'DEC');

// remplir le tableau
$cpt=1;
for ($i=0;$i<12;$i++){
	$tab_notes[$i] = $cpt;
	$cpt+=1;
}
// remplir le tableau
/* while ($row_type_produits = mysql_fetch_array($mysqlQuery, MYSQL_ASSOC))
if ($row_type_produits['TYPE_PRODUIT'] == 'MATERIEL')
$tab_materiel[$row_type_produits['MOIS']-1] =
$ row_type_produits['CHIFFRE_AFFAIRES'];*/


// *********************
// Création du graphique
// *********************


// Création du conteneur type radar
$graph = new RadarGraph(600,600,"auto");

// Représentation logarithmique
// Permet le lissage en changeant l'échelle
$graph->SetScale("log");

// Paramétrage de l'apparence du grahique
$graph->title->Set("Graphique audit");
$graph->title->SetFont(FF_VERDANA,FS_NORMAL,12);
$graph->SetTitles($descItems);
// Position du graphique par rapport au centre
$graph->SetCenter(0.50,0.55);
// Cacher les marques
$graph->HideTickMarks();
// Couleur de fond
$graph->SetColor('#cccccc@0.3');
$graph->axis->SetColor('blue@0.5');
$graph->grid->SetColor('blue@0.5');
$graph->grid->Show();
$graph->axis->title->SetFont(FF_ARIAL,FS_NORMAL,10);
$graph->axis->title->SetMargin(5);
// Créer les points
$plot1 = new RadarPlot($tab_notes);
// Ajouter les points au graphique
$graph->Add($plot1);
// Couleur de la ligne
$plot1->SetColor('red');
// Epaisseur de la ligne qui relie les points
$plot1->SetLineWeight(1);
// Couleur de remplissage
$plot1->SetFillColor('red@0.8');
// Apparence des points
$plot1->mark->SetType(MARK_SQUARE);
$graph->Stroke(); 

?>
<!--
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

</html> -->

