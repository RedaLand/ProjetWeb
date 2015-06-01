<?php include('./fonctions.php');


$mail=$_POST['mail'];
$mail2=$_POST['mail2'];

$connect = ConnexionDB(); // Je me connecte à la base de donnée
$espace =" ";

	if ($mail != $mail2){
		echo 'Les 2 adresses mail sont differentes.';
	}
	else{
		// on recherche si ce login est dÃ©jÃ  utilisÃ© par un autre membre
		$sql1 = "SELECT count(*) FROM medecins WHERE Mail_Medecin='$mail'";
		$req = $connect->query($sql1);
		$data = mysqli_fetch_array($req);

		if ($data[0] == 0) {
			echo 'Personne n\'utilise cette adresse mail.';
		}
		else{
			echo 'Un membre est déjà  inscrit avec cette adresse mail.';
		}
	}

?>

