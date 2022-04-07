<?php
header( 'content-type: text/html; charset=utf-8' );
session_start();
if (isset($_GET['default'])) 
{
$default_audit = 1;
$jsonhref = "./audits_creation/.default.json";
        $json = file_get_contents($jsonhref);
        $json_d = json_decode($json);
}
else {
    $default_audit = 0;

    if (isset($_POST['audit'])) {
        $jsonhref = "./audits_creation/" . $_POST['audit'];
        $json = file_get_contents($jsonhref);
        $json_d = json_decode($json);
        /*foreach ($json_d as $key => $jsons) { // This will search in the 2 jsons
            echo "key $key:\n";
            foreach ($jsons as $key => $value) {
                echo "keys $key => $value\n";
            }
        }*/
    }
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
    <title>Sandy | Creation</title>
</head>

<body>
<img src="../img/logo.svg" class="logo" style="margin-left: 25%;" alt="logo"><br><br><br><br>
    <table class="table table-bordered tree-add tree-move tree-remove">
        <thead>
            <tr>
                <td class="app"><?php echo $_SESSION['name']; ?></td>
                <td class="intitule">Intitule</td>
                <td class="desc">Descriptif</td>
                <td class="tools" colspan="3" style="text-align: center;">Outils</td>
            </tr>
        </thead>
        <tbody>
            <tr class="node has-node treegrid-0 expanded">
                <td class="noeud">Racine</td>
                <?php
                if ($default_audit) {
                    echo '<td class="intitule" contenteditable="true">' . $_SESSION['name'] . '</td>';
                } 
				else {
                    echo '<td class="intitule" contenteditable="true">' . $json_d[0]->init . '</td>';
                }
                
                echo '<td class="desc" contenteditable="true">' . $json_d[0]->desc . '</td>';
                ?>
                <td class="add-node" colspan="3" style="text-align: center;">
                    <a href="#" class="tree-add-root">Ajouter un noeud sous la racine</a>
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
                    if ($type == 'node') {
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
                        echo '<td class="del-node"><a href="#" class="tree-remove-node">Supprimer un noeud</a></td></tr>';
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

            ?>
        </tbody>
    </table>
    <?php
if ($default_audit) {
    echo '<button id="export_audit" class="btn-grad" style="margin-left: 50px;">Enregistrer l\'audit</button>';
} else {
    echo '<button id="export_audit" class="btn-grad" style="margin-left: 50px;">Enregistrer les modifications</button>';
}
    ?>
	<br><br>
        <a href="../index.php"><input type="button" class="btn-grad" value="Retour au menu" style="width: 200px;"></a>
<br><br>Sandy V0.1
</body>
<footer>
    <script src="../scripts/jquery-1.12.4.js"></script>
    <script src="../scripts/jquery-ui-1.12.1.js"></script>
    <script src="../scripts/jquery.treegrid.custom.js"></script>
    <script src="../scripts/bootstrap.bundle.min.js"></script>
    <script src="../scripts/sandy.js"></script>
    <script src="../scripts/export_creation.js"></script>   
</footer>
</html>