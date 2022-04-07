<!DOCTYPE html>
<html lang="fr">
    <?php
        session_start();
        $_SESSION['name'] = '';
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SANDY | Audit Tool</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>    
    <img src="../img/logo.svg" class="logo" alt="logo"><br><br>
    <div class="container">
        <h2 class="content">Téléverser un audit au format .csv ou .xml.</h2><br><br>    

    <form enctype="multipart/form-data" class="content" action="saveAudit.php" method="post">
      <input type="hidden"  class="btn-grad" name="MAX_FILE_SIZE" value="100000" />
      <div class="content">Chercher un fichier à téléverser <input type="file"  name="monfichier" /></div><br>
      <input type="submit" class="btn-grad" />
    </form>
	<br><br><br>
        <a href="../index.php"><input type="button" class="btn-grad" value="Retour au menu" style="width: 200px;"></a>
  </body>
</html>