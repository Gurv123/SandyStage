<?php
header('content-type: text/html; charset=utf-8');
session_start();
if (isset($_POST['audit'])) {
    $jsonhref = "../creation/audits_creation/" . $_POST['audit'];
    $json = file_get_contents($jsonhref);
    $json_d = json_decode($json);
	
    /*foreach ($json_d as $key => $jsons) { // This will search in the 2 jsons
echo "key $key:\n";
foreach ($jsons as $key => $value) {
echo "keys $key => $value\n";
}
}*/
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
    <title>Sandy | Réalisation</title>
</head>

<body>
    <img src="../img/logo.svg" class="logo" style="margin-left: 25%;" alt="logo"><br><br><br><br>
    <table class="table table-bordered tree-add tree-move tree-remove">
        <thead>
            <tr>
                <td class="app">Sandy V0.1 <?php echo "- ".$_POST['audit']; ?></td>
                <td class="desc">Descriptif</td>
                <td class="tools" style="text-align: center;">Note</td>
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
					//$note = $json_d[$key]->note;
                    if (substr($json_d[$key]->id, 0, -2) != '') {
                        $pere = substr($json_d[$key]->id, 0, -2);
                    } else {
                        $pere = 0;
                    }
                    $init = $json_d[$key]->init;
                    $desc = $json_d[$key]->desc;
                    $has = $json_d[$key]->has;
                    if ($type == 'node') {
                        echo '<tr style="background-color:lightgray;"class="node treegrid-' . $id . ' ' . $has . ' treegrid-parent-' . $pere . ' expanded" >';
                        echo '<td class="noeud"> ' . $init . '</td>';
                        echo '<td class="desc"">' . $desc . '</td>';
						echo '<td class="note"></td>';
                        //echo '<td class="note">' . $note . '</td>';
                    } elseif ($type == 'item') {
                        echo '<tr class="item treegrid-' . $id . ' treegrid-parent-' . $pere . '">';
                        echo '<td class="noeud" style="padding-top:42.5px;"> ' . $init . '</td>';
                        echo '<td class="desc" style="padding-top:42.5px;">' . $desc . '</td>';
                        echo '<td class="note">
                        <form action="#" id="form-note-' . $id . '">
                            <fieldset>
                                <select name="note" id="note-' . $id . '">
                                    <option value="0" selected="selected">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
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
    <button id="export_audit" class="btn-grad">Enregistrer l'audit</button>
    <a href="../index.php"><button class="btn-grad">Retour au menu</button></a>
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