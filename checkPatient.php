<?php include('./fonctions.php');

	$id = $_POST['identifiant']; 
	$connect = ConnexionDB(); // Je me connecte à la base de donnée
	$espace =" "; // On récupère la liste des membres et on check si le pseudo existe déjà
	$nombrepatient = "SELECT count(*) FROM patients WHERE Numero_Piece_ID='$id'" or die("Erreur lors de la consultation de données (Verif ID)" . mysqli_error($connect));
	$nompatient = "SELECT Nom_Patients FROM patients WHERE Numero_Piece_ID='$id'" or die("Erreur lors de la consultation de données (Verif ID)" . mysqli_error($connect));
   	$listenombre = $connect->query($nombrepatient);
  	$listenoms = $connect->query($nompatient);
   	$nbpatient = mysqli_fetch_array($listenombre);
  	$nompatient = mysqli_fetch_array($listenoms);

	// Si le pseuo existe déjà on retourne non
	if($nbpatient[0] == 1){
		echo 'Cliquez sur SORTIR LE DOSSIER pour acceder au dossier de M. (Mme)',$espace, $nompatient[0];
	}
	else
	{
		echo 'Ce patient n\'existe pas';
	}


?>

