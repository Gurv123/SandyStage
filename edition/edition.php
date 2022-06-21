<?php

session_start();

if (isset($_POST['audit'])) {
    $jsonhref = "./audits_edition/" . $_POST['audit'];
    $json = file_get_contents($jsonhref);
    $json_d = json_decode($json);    
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
    <title>Sandy | Edition</title>
</head>

<body>
    <img src="../img/logo.svg" class="logo"alt="logo">
    <table class="table table-bordered tree-add tree-move tree-remove">
        <thead>
            <tr>
                <td class="app">Sandy V0.1 <?php echo "- ".$_POST['audit']; ?></td>
                <td class="desc">Descriptif</td>
                <td class="tools" width="35%" style="text-align: center;">Note</td>
                <td class="doc">Documents</td>
            </tr>
        </thead>
        <tbody>
            <tr class="node has-node treegrid-0 expanded">
                <?php
                echo '<td class="noeud">' . $json_d[0]->init . '</td>';
                echo '<td class="desc"">' . $json_d[0]->desc . '</td>';
                ?>
                <td class="note" style="text-align: center;">
                </td>
            </tr>
            <?php
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
					$note = $json_d[$key]->note;
                    $doc = $json_d[$key]->doc;
                    if ($type == 'node') {
                        echo '<tr style="background-color:lightgray;"class="node treegrid-' . $id . ' ' . $has . ' treegrid-parent-' . $pere . ' expanded" >';
                        echo '<td class="noeud"> ' . $init . '</td>';
                        echo '<td class="desc"">' . $desc . '</td>';
                        echo '<td class="note">' . $note . '</td>';
                        echo '<td><a class="path" href="../document/audit_doc/'.$doc.'" target="_blank">'.$doc.'</a></td></tr>';
                    } elseif ($type == 'item') {
                        echo '<tr class="item treegrid-' . $id . ' treegrid-parent-' . $pere . '">';
                        echo '<td class="noeud" style="padding-top:42.5px;"> ' . $init . '</td>';
                        echo '<td class="desc" style="padding-top:42.5px;">' . $desc . '</td>';
                        echo '<td class="note">
                        <form action="#" id="form-note-' . $id . '">
                            <fieldset>
                                <select name="note" id="note-' . $id . '">';
									switch($note){
										case 0:
											echo '	<option value="0" selected="selected">0</option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>';
											break;
										case 1:
											echo '	<option value="0">0</option>
													<option value="1" selected="selected">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>';
											break;
										case 2:
											echo '	<option value="0">0</option>
													<option value="1">1</option>
													<option value="2" selected="selected">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>';
											break;
										case 3:
											echo '	<option value="0">0</option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3" selected="selected">3</option>
													<option value="4">4</option>
													<option value="5">5</option>';
											break;
										case 4:
											echo '	<option value="0">0</option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4" selected="selected">4</option>
													<option value="5">5</option>';
											break;
										case 5:
											echo '	<option value="0">0</option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5" selected="selected">5</option>';
									}
                             echo ' </select>
                            </fieldset>
                        </form>
                    </td>';
                    } else {
                        error_log("Type inconnu");
                    }
                }
            }
            ?>
        </tbody>
    </table>
    <button id="export_audit" class="btn-grad">Modifier l'audit</button>
	<form id='$name' action='graphe.php' method='post'>
		<button type="submit" id="graph_radar" class="btn-grad">Graphique</button>
		<input type='hidden' name='audit' value='<?php echo $_POST["audit"]; ?>'/>
	</form>
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