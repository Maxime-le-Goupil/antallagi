<?php
	$bdd = new PDO('mysql:host=localhost;dbname=antallagi;charset=utf8', 'root', 'root');
	
	$id = htmlspecialchars($_POST['id']);
	$mdp = htmlspecialchars($_POST['mdp']);
	
	$pass_hache = sha1($mdp);
	
	$req = $bdd->prepare('SELECT num,pseudo FROM etudiant WHERE id = :id AND mdp = :mdp');
	$req->execute(array(
		'id' => $id,
		'mdp' => $pass_hache));
	$resultat = $req->fetch();
	
	if ($resultat)
	{
		echo 'Vous êtes co élève';
		session_start();
		$_SESSION['ide'] = $resultat['num'];
		$_SESSION['name'] = $resultat['pseudo'];
		header('Location: espace-client/main.php');
		
	}
	else{
		//echo 'Mauvais identifiant ou mot de passe !';
		header('Location: login-etudiant.php?mdp=1&amp;deco=0');
	}
	

?>
