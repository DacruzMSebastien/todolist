<?php

 // sanitize
	$_POST["tache"] = filter_var($_POST["tache"], FILTER_SANITIZE_STRING);


	$json_file = file_get_contents('todo.json');
	$data = json_decode($json_file, true);

	// on encode les tâches
	if(isset($_POST["tache"])) {
		$tache = htmlspecialchars($_POST["tache"]);
	// on ajoute la tâche dans le tableau $data
		$data["todo"][] = $tache;
	//Le tableau retourne au format JSON
		$encodage_tableau = json_encode($data, JSON_FORCE_OBJECT|JSON_PRETTY_PRINT);
	//On ajoute le tableau dans le fichier JSON
		file_put_contents('todo.json' , $encodage_tableau);
		}


	if (isset($_POST['case'])){
		$archives = $_POST['case'];
	// on ajoute les taches cochées dans le tableau archives de $data
		foreach ($archives as $key => $value) {
			$data["archives"][] = $value;
		}

	//On écrase le premier tableau en comparant $archives avec l'ancien "todo"
		$data["todo"] = array_diff( $data["todo"] , $archives);
		$encodage_tableau = json_encode($data, JSON_FORCE_OBJECT|JSON_PRETTY_PRINT);
		file_put_contents('todo.json' , $encodage_tableau);
	}
/* SUPPRIMER LES TACHES ARCHIVEES */
	if (isset($_POST['clean'])) {
	//on nettoie à l'affichage
		foreach ($data["archives"] as $key => $value) {
			unset($data["archives"][$key]);
		}
	/* On réécrit le tableau todo du fichier JSON */
		$encodage_tableau = json_encode($data, JSON_FORCE_OBJECT|JSON_PRETTY_PRINT);
		file_put_contents('todo.json' , $encodage_tableau);
	}

	if(isset($_GET['sortPosition'])) {
	$sortPosition = $_GET['sortPosition'];
	$sortPosition = explode(',', $sortPosition);
	$sortPosition = ['top','left'];
	}
?>


<!DOCTYPE html>
<html>
  <head>
  	<title>To do list</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
  </head>
<body>
	<div>
	<section>
		<form method="POST">
	    	<h1>To Do List</h1>
			<input class="text" type="text" name="tache" placeholder="What do you want to do?" maxlength="50" required>
			<input type="submit" class="button submitTask">
		</form>
	</section>
<?php include 'contenu.php'; ?>
	</div>
</body>
</html>


<?php

	//if(isset($_GET['sortPosition'])) {
		//$sortPosition = $_GET['sortPosition'];
		//$sortPosition = explode(',', $sortPosition);
		//$sortPosition = ['top','left'];
	//}
	?>
