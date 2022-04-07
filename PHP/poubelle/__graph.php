
<?php
include ("../jpgraph/jpgraph.php");
include ("../jpgraph/jpgraph_radar.php");
include ("../jpgraph/jpgraph_log.php");

header('content-type: text/html; charset=utf-8');
session_start();

$tab_notes = array();
//$descItems = array();
/*
if (isset($_POST['audit'])) {
    $jsonhref = "../edition/audits_edition/" . $_POST['audit'];
    $json = file_get_contents($jsonhref);
    $json_d = json_decode($json);
*/	
    /*foreach ($json_d as $key => $jsons) { // This will search in the 2 jsons
echo "key $key:\n";
foreach ($jsons as $key => $value) {
echo "keys $key => $value\n";
}
}*/
/*
	foreach ($json_d as $key => $jsons) { // This will search in the 2 jsons
					if ($key > 0) {
						$type = $json_d[$key]->type;
						$id = $json_d[$key]->id;
						if (substr($json_d[$key]->id, 0, -2) != '') {
							$pere = substr($json_d[$key]->id, 0, -2);
						} else {
							$pere = 0;
						}
						$init = $json_d[$key]->init;
						$desc = $json_d[$key]->desc;
						$has = $json_d[$key]->has;
						if ($type == 'node') {
							//$descItems = array('JAN', 'FEV', 'MAR', 'AVR', 'MAI', 'JUI', 'JUL', 'AOU', 'SEP', 'OCT');
							echo '<tr class="node treegrid-' . $id . ' ' . $has . ' treegrid-parent-' . $pere . ' expanded" >';
							echo '<td class="noeud">Noeud ' . $id . '</td>';
							echo '<td class="intitule" contenteditable="true">' . $init . '</td>';
							echo '<td class="desc" contenteditable="true">' . $desc . '</td>';
							echo '<td class="add-node"><a href="#" class="tree-add-node ';
							if ($has == 'has-item') {
								echo 'disabled';
							};
							echo '">Ajouter un noeud enfant</a></td>';
							echo '<td class="add-item"><a href="#" class="tree-add-item ';
							if ($has == 'has-node') {
								echo 'disabled';
							};
							echo '">Ajouter un item</a></td>';
							echo '<td class="del-node"><a href="#" class="tree-remove-node disabled">Supprimer un noeud</a></td></tr>';
						} elseif ($type == 'item') {
							echo '<tr class="item treegrid-' . $id . ' treegrid-parent-' . $pere . '">';
							echo '<td class="noeud">Item ' . $id . '</td>';
							echo '<td class="intitule" contenteditable="true">' . $init . '</td>';
							echo '<td class="desc" contenteditable="true">' . $desc . '</td>';
							echo '<td class="del-item" colspan="3" style="text-align: center;"><a href="#" class="tree-remove-item">Supprimer un item</a></td></tr>';
						} else {
							error_log("Type inconnu");
						}
					}
				}
	*/		
//}






$descItems = array('JAN', 'FEV', 'MAR', 'AVR', 'MAI', 'JUI', 'JUL', 'AOU', 'SEP', 'OCT');

// initialiser le tableau
$cpt=0;
for ($i=0;$i<10;$i++){
	$tab_notes[$i] = $cpt;
	$cpt+=0.5;
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
$graph = new RadarGraph (600,600,"auto");

// Représentation logarithmique
// Permet le lissage en changeant l'échelle
//$graph->SetScale("log");

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
    <title>Sandy | Edition</title>
</head>

<body>
    <img src="../img/logo.svg" class="logo" style="margin-left: 25%;" alt="logo"><br><br><br><br>
	
    <table class="table table-bordered tree-add tree-move tree-remove">
        <thead>
            <tr>
                <td class="app">Sandy V0.1 <?php /*echo "- ".$_POST['audit'];*/ ?></td>
                <td class="desc">Descriptif</td>
                <td class="tools" style="text-align: center;">Note</td>
            </tr>
        </thead>
        <tbody>
            <tr class="node has-node treegrid-0 expanded">
                <?php /*
                echo '<td class="noeud">' . $json_d[0]->init . '</td>';
                echo '<td class="desc"">' . $json_d[0]->desc . '</td>';*/
                ?>
                <td class="note" style="text-align: center;">
                </td>
            </tr>
            
        </tbody>
    </table>
    <button id="export_audit" class="btn-grad" style="margin-left: 50px;">Enregistrer l'audit</button>
	
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