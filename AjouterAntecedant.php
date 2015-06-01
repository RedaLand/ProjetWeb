<?php include('./fonctions.php');

	$typeantecedant = $_POST['typeantecedant']; 
	$remarqueantecedant = $_POST['remarqueantecedant']; 
	$medecinantecedant = $_POST['medecinantecedant']; 
	$patientantecedant = $_POST['patientantecedant']; 
	$secretmedical = $_POST['secretmedical']; 

	$connect = ConnexionDB(); // Je me connecte à la base de donnée
	$IDMedecin = "SELECT ID_Medecin FROM medecins WHERE Mail_Medecin='$medecinantecedant'" or die("Erreur lors de la consultation de données (Verif ID)" . mysqli_error($connect));
  	$ListeID = $connect->query($IDMedecin);
  	$IDMedecinFinal = mysqli_fetch_array($ListeID);

  	if($secretmedical=='True'){
		$InsertionantecedantSecret = "INSERT INTO antecedants (ID_Patient, ID_Medecin, Type_Antecedant, Remarque_Antecedant, Secret_Antecedant) VALUES ('$patientantecedant', '$IDMedecinFinal[0]', '$typeantecedant', '$remarqueantecedant', 'True')" or die("Erreur lors de l'insertion de données (antecedants)" . mysqli_error($connect));
		$inserer = $connect -> query($InsertionantecedantSecret);
		echo 'Ajout de l\'antécedant avec secret médical éffectuée';
		header("Refresh: 3; URL= /RecupererDossier.php?numPatient=".$patientantecedant);
  	}
  	else if($secretmedical!='True'){
		$Insertionantecedant = "INSERT INTO antecedants (ID_Patient, ID_Medecin, Type_Antecedant, Remarque_Antecedant, Secret_Antecedant) VALUES ('$patientantecedant', '$IDMedecinFinal[0]', '$typeantecedant', '$remarqueantecedant', 'False')" or die("Erreur lors de l'insertion de données (antecedants)" . mysqli_error($connect));
		$inserer1 = $connect -> query($Insertionantecedant);
		echo 'Ajout de l\'antécedant éffectuée';
		header("Refresh: 3; URL= /RecupererDossier.php?numPatient=".$patientantecedant);
  	}
  	else{
  		echo 'Echec de l\'ajout';
		header("Refresh: 3; URL= /RecupererDossier.php?numPatient=".$patientantecedant);
  	}
?>


