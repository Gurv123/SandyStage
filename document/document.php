<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/style.css">
  <link rel="stylesheet" href="../search/.style.css">
  <title>SANDY | Mes documents</title>
  <script src="../search/.sorttable.js"></script>
</head>
<body>
  <?php
    $message="";

    if(isset($_POST['upload'])){ // si formulaire soumis

      $content_dir = 'audit_doc/'; // dossier où sera déplacé le fichier
        
      $nbLignes=count($_FILES['mesfichier']['name']);
        
      for($i=0 ; $i<=$nbLignes-1 ; $i++){
        $tmp_file = $_FILES['mesfichier']['tmp_name'][$i];
 
        if(!is_uploaded_file($tmp_file)){
          $message="<p>Le fichier est introuvable</p>";
        }else{
          // on vérifie maintenant l'extension
          $type_file = $_FILES['mesfichier']['type'][$i];
 
          if($type_file != "application/pdf"){
            $message = "<p>Le fichier n'est pas un fichier pdf</p>";
          }else{
            // on copie le fichier dans le dossier de destination
            $name_file = $_FILES['mesfichier']['name'][$i];
            if (file_exists($content_dir . $name_file)){
              $message = "<p>Le fichier existe déjà, veuillez choisir un autre fichier, ou modifier son nom.</p>";
            }else{
              if( !move_uploaded_file($tmp_file, $content_dir . $name_file)){
                $message = "<p>Impossible de copier le fichier dans $content_dir</p>";
              }else{
                $message = "<p>Le fichier a bien été uploadé</p>";
              }
            }
          }
        }              
      }
    }


    if(isset($_POST['checked'])  && isset($_POST['suppr'])){
      $myDirectory = opendir("./audit_doc/");
      
      for($i=0; $i< count($_POST['checked']); $i++){
        $path = "./audit_doc/".$_POST['checked'][$i];
        unlink($path);
      }

      closedir($myDirectory);
    }
  ?>

  <img src="../img/logo.svg" class="logo" alt="logo">
  
  <h2 class="content">Téléverser vos documents au format .pdf.</h2>  

  <form enctype="multipart/form-data" class="content" action="document.php" method="post">
    <input type="hidden"  class="btn-grad" name="MAX_FILE_SIZE" value="500000" />

    <div class="content">Chercher un/des fichier à téléverser <input type="file" id="fichier" name="mesfichier[]" multiple/></div>

    <?php echo $message;?>

    <input type="submit" class="btn-grad" name="upload"/>
  </form>

  <div class="doc-table">
    <?php 
    // Opens directory
    $myDirectory=opendir("./audit_doc/");
    $path="./audit_doc/";

    if(glob($path."*")){
      echo ("<table class=\"sortable\">
              <thead>
                <tr>
                  <th>Nom du fichier</th>
                  <th>Taille</th>
                  <th>Ajouté le</th>
                  <th><th>
                </tr>
              </thead>
              <tbody>");
      setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
      // Adds pretty filesizes

      function pretty_filesize($file){
        $size=filesize($file);
        if($size<1024){$size=$size." Bytes";}
        elseif(($size<1048576)&&($size>1023)){$size=round($size/1024, 1)." KB";}
        elseif(($size<1073741824)&&($size>1048575)){$size=round($size/1048576, 1)." MB";}
        else{$size=round($size/1073741824, 1)." GB";}
        return $size;
      }

      // Checks to see if veiwing hidden files is enabled
      if($_SERVER['QUERY_STRING']=="hidden"){
        $hide="";
        $ahref="./";
        $atext="Hide";
        } else	{
          $hide=".";
          $ahref="./?hidden";
          $atext="Show";
        }

        // Gets each entry
        while($entryName = readdir($myDirectory)){
          $pathinfo = pathinfo($entryName);

          if ($pathinfo['extension'] == 'pdf' && $pathinfo['basename'][0] != '.'){
            $dirArray[] = $entryName;
          }          
        }

        // Closes directory
        closedir($myDirectory);

        // Counts elements in array
        $indexCount=count($dirArray);

        // Sorts files
        sort($dirArray);

        // Loops through the array of files
        for($index=0; $index < $indexCount; $index++){
          // Decides if hidden files should be displayed, based on query above.
          if(substr("$dirArray[$index]", 0, 1)!=$hide) {
            // Resets Variables
            $favicon="";
            $class="file";

            // Gets File Names
            $name=$dirArray[$index];
            $namehref=$path .$dirArray[$index];

            // Gets Date Modified
            $modtime=date("M j Y g:i A", filemtime($path .$dirArray[$index]));
            $timekey=date("YmdHis", filemtime($path .$dirArray[$index]));

            // Separates directories, and performs operations on those directories
            if(is_dir($dirArray[$index])){
              $extn="&lt;Directory&gt;";
              $size="&lt;Directory&gt;";
              $sizekey="0";
              $class="dir";

              // Gets favicon.ico, and displays it, only if it exists.
              if(file_exists("$namehref/favicon.ico")){
                $favicon=" style='background-image:url($namehref/favicon.ico);'";
                $extn="&lt;Website&gt;";
              }

              // Cleans up . and .. directories
              if($name=="."){$name=". (Current Directory)"; $extn="&lt;System Dir&gt;"; $favicon=" style='background-image:url($namehref/.favicon.ico);'";}
              if($name==".."){$name=".. (Parent Directory)"; $extn="&lt;System Dir&gt;";}
            } else{
              // Gets file extension
              $extn=pathinfo($dirArray[$index], PATHINFO_EXTENSION);

              // Gets and cleans up file size
              $size=pretty_filesize($path .$dirArray[$index]);
              $sizekey=filesize($path .$dirArray[$index]);
            }

            // Output
            $modtime=strftime("%A %e %b %Y, %R", filemtime($path .$dirArray[$index]));

            //$timekey=strftime("%A", filemtime($path .$dirArray[$index]));
            echo("
            <form method='POST' action='document.php' >
              <tr class='$class'>
                <td>
                  <a href='audit_doc/$name' target='_blank'>$name</a>    
                </td>

                <td sorttable_customkey='$sizekey'>
                  <a href='audit_doc/$name' target='_blank'>$size</a>
                </td>

                <td sorttable_customkey='$timekey'>
                  <a href='audit_doc/$name' target='_blank'>$modtime</a>
                </td>

                <td>
                  <input type='checkbox' name='checked[]' value='$name'/>
                </td>
              </tr>");
          }
        }
        echo ("
            </tbody> 
          </table>
          <p class='btn-suppr'><input type='submit' name='suppr' value='Supprimer' class='btn-grad'/></p>
        </form>");
    } ?>
  </div>

  <a href="../index.php"><button class="btn-grad">Retour au menu</button></a>
  <p>Sandy V0.1</p>
</body>
</html>