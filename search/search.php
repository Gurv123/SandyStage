<!doctype html>

<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./.style.css">
	<script src="./.sorttable.js"></script>
<?php
//header('content-type: text/html; charset=utf-8');
	echo '<title>Sandy | '.ucfirst($_GET['audit']).'</title>';
	if(isset($_GET['audit']))
	{
		if (($_GET['audit'])=='modification') 
		{
			echo '<h1>Audits pour modification</h1>';
		} 
		elseif (($_GET['audit'])=='edition') 
		{
			echo '<h1>Audits pour édition</h1>';	
		}
		elseif (($_GET['audit'])=='realisation') {
			echo "<h1>Audits pour réalisation</h1>";	
		}
		elseif (($_GET['audit'])=='creation') {
			echo "<h1>Créer un audit</h1>";	
			header('Location: ../creation/creationAudit.php');
			exit();
		}
	}
	?>
</head>
<body>
	<div id="container">
	<table class="sortable">
	    <thead>
		<tr>
			<th>Nom du fichier</th>
			<th>Taille</th>
			<th>Dernière modification</th>
		</tr>
	    </thead>
	    <tbody>
		<?php
		setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
		// Adds pretty filesizes
		function pretty_filesize($file) {
			$size=filesize($file);
			if($size<1024){$size=$size." Bytes";}
			elseif(($size<1048576)&&($size>1023)){$size=round($size/1024, 1)." KB";}
			elseif(($size<1073741824)&&($size>1048575)){$size=round($size/1048576, 1)." MB";}
			else{$size=round($size/1073741824, 1)." GB";}
			return $size;
		}

		// Checks to see if veiwing hidden files is enabled
		if($_SERVER['QUERY_STRING']=="hidden")	{
			$hide="";
		$ahref="./";
		$atext="Hide";
		}
		else	{
			$hide=".";
		$ahref="./?hidden";
		$atext="Show";
		}

		// Opens directory
		$myDirectory;
		$path;
		if(isset($_GET['audit'])){
			if ($_GET['audit']=='modification' || $_GET['audit']=='realisation') {
				$myDirectory=opendir("../creation/audits_creation/");
				$path=	"../creation/audits_creation/";
			} 
			elseif (($_GET['audit'])=='edition') {
				$myDirectory=opendir("../edition/audits_edition/");
				$path=	"../edition/audits_edition/";
			}
		}
		
		// Gets each entry

		while($entryName = readdir($myDirectory)) {
			$pathinfo = pathinfo($entryName);
			if ($pathinfo['extension'] == 'json' && $pathinfo['basename'][0] != '.')
			$dirArray[] = $entryName;
		}

		// Closes directory
		closedir($myDirectory);

		// Counts elements in array
		$indexCount=count($dirArray);

		// Sorts files
		sort($dirArray);

		// Loops through the array of files
		for($index=0; $index < $indexCount; $index++) {

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
				if(file_exists("$namehref/favicon.ico"))
					{
						$favicon=" style='background-image:url($namehref/favicon.ico);'";
						$extn="&lt;Website&gt;";
					}

			// Cleans up . and .. directories
				if($name=="."){$name=". (Current Directory)"; $extn="&lt;System Dir&gt;"; $favicon=" style='background-image:url($namehref/.favicon.ico);'";}
				if($name==".."){$name=".. (Parent Directory)"; $extn="&lt;System Dir&gt;";}
			}

		// File-only operations
			else{
				// Gets file extension
				$extn=pathinfo($dirArray[$index], PATHINFO_EXTENSION);

				// Prettifies file type
				
				// Gets and cleans up file size
					$size=pretty_filesize($path .$dirArray[$index]);
					$sizekey=filesize($path .$dirArray[$index]);
			}

		// Output
		$modtime=strftime("%A %e %b %Y, %R", filemtime($path .$dirArray[$index]));
		//$timekey=strftime("%A", filemtime($path .$dirArray[$index]));
		if(isset($_GET['audit'])){
			if ($_GET['audit']=='modification') {
				echo "<form id='$name' action='../creation/creation.php' method='post'>";	
			} 
			elseif ($_GET['audit']=='edition') {
				echo "<form id='$name' action='../edition/edition.php' method='post'>";	
			}
			elseif ($_GET['audit']=='realisation') {
				echo "<form id='$name' action='../realisation/realisation.php' method='post'>";	
			}
			echo("<tr class='$class'>
					<td>
						<a href='javascript:' onclick='document.getElementById(\"$name\").submit()'>$name</a>    
					</td>
					<td sorttable_customkey='$sizekey'>
						<a href='javascript:' onclick='document.getElementById(\"$name\").submit()'>$size</a>
					</td>
					<td sorttable_customkey='$timekey'>
						<a href='javascript:' onclick='document.getElementById(\"$name\").submit()'>$modtime</a>
					</td>
				</tr>
				<input type='hidden' name='audit' value='$name'/>
			</form> ");
	  		 }
		}
		}
	?>

	    </tbody>
	</table>
	

	
</div>
<br><br>
    <a href="../index.php"><input type="button" class="btn-grad" value="Retour au menu" style="width: 200px;"></a>
</body>

</html>