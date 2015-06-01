<?php include('./fonctions.php');

	$lienordonnance = $_POST['lienordonnance']; 
	$remarqueordonnance = $_POST['remarqueordonnance']; 
	$medecinordonnance = $_POST['medecinordonnance']; 
	$patientordonnance = $_POST['patientordonnance']; 


	$connect = ConnexionDB(); // Je me connecte à la base de donnée
	$IDMedecin = "SELECT ID_Medecin FROM medecins WHERE Mail_Medecin='$medecinordonnance'" or die("Erreur lors de la consultation de données (Verif ID)" . mysqli_error($connect));
  	$ListeID = $connect->query($IDMedecin);
  	$IDMedecinFinal = mysqli_fetch_array($ListeID);
  	$dateAujourdhui = date("d/m/Y", time());
  	if(empty($lienordonnance)){
		$InsertionantecedantSecret = "INSERT INTO ordonnances (Numero_Piece_ID, ID_Medecin, Date_Edition_Ordonnance, Remarque_Ordonnance) VALUES ('$patientordonnance', '$IDMedecinFinal[0]', '$dateAujourdhui', '$remarqueordonnance')" or die("Erreur lors de l'insertion de données (antecedants)" . mysqli_error($connect));
		$inserer = $connect -> query($InsertionantecedantSecret);
		echo 'Ajout de l\'ordonnance avec secret médical éffectué';
		header("Refresh: 3; URL= /RecupererDossier.php?numPatient=".$patientordonnance);
  	}
  	else if(empty($remarqueordonnance)){
		$Insertionantecedant = "INSERT INTO ordonnances (Numero_Piece_ID, ID_Medecin, Date_Edition_Ordonnance , LienPhoto) VALUES ('$patientordonnance', '$IDMedecinFinal[0]', '$dateAujourdhui', '$lienordonnance')" or die("Erreur lors de l'insertion de données (antecedants)" . mysqli_error($connect));
		$inserer1 = $connect -> query($Insertionantecedant);
		echo 'Ajout de l\'ordonnance éffectué';
		header("Refresh: 3; URL= /RecupererDossier.php?numPatient=".$patientordonnance);
  	}
  	else{
  		echo 'Echec de l\'ajout! Vous ne devez pas mettre le lien ET une remarque !';
		header("Refresh: 3; URL= /RecupererDossier.php?numPatient=".$patientordonnance);
  	}

?>


