<?php

$prenom = $_POST['prenom'];
$nom=$_POST['nom'];
$mdp=md5($_POST['mdp']);
$mdp2=md5($_POST['mdp2']);
$numrue=$_POST['numrue'];
$nomrue=$_POST['nomrue'];
$departement=$_POST['departement'];
$datenaissance=$_POST['datenaissance'];
$specialite=$_POST['specialite'];
$mail=$_POST['mail'];
$mail2=$_POST['mail2'];


if (!empty($prenom) && !empty($nom) && !empty($mdp) && !empty($mdp2) && !empty($mail) && !empty($mail2) && !empty($numrue) && !empty($nomrue) && !empty($specialite)){
	if ($mdp != $mdp2){
		print("Les 2 mots de passe sont differents.");
	}
	if ($mail != $mail2){
		print("Les 2 adresses mail sont differentes.");
	}
	else{
		// DÃ©claration des paramÃ¨tres de connexion
   		include ("./fonctions.php");
     	$connect = ConnexionDB();	

     	// On traduit la specialite qui a la base est un char (cardiologue, generaliste..) en int !
     	$traduction = "SELECT ID_Specialites from specialites where Lib_Specialite='$specialite'" or die("Erreur lors de la consultation de données (traduction spécialite)" . mysqli_error($connect));
     	$reptraduction = $connect -> query($traduction);
		$numspecialite = mysqli_fetch_array($reptraduction);

		// on recherche si ce login est dÃ©jÃ  utilisÃ© par un autre membre
		$sql1 = "SELECT count(*) FROM medecins WHERE Mail_Medecin='$mail'";
		$req = $connect->query($sql1);
		$data = mysqli_fetch_array($req);

		if ($data[0] == 0) {
			$sql = "INSERT INTO `medecins` (`Nom_Medecin`, `Prenom_Medecin`, `Mail_Medecin`, `MDP_Medecin`, `Specialite_Medecin`, `Date_Naiss_Medecin`, `Region_Cabinet_Medecin`, `Num_Rue_Medecin`, `Nom_Rue_Medecin`) VALUES('$nom', '$prenom' , '$mail' , '$mdp', '$numspecialite[0]', '$datenaissance', '$departement', '$numrue', '$nomrue')" or die("Erreur lors de la consultation de données (Insertion medecin)" . mysqli_error($connect));
			$inserer = $connect -> query($sql);
			print("Inscription prise en compte. Vous recevrez bientôt un mail de confirmation.");
		}
		else{
			print("Un membre est déjà  inscrit avec cette adresse mail.");
		}
	}
}
else{
	print("Un des champs est vide. Nous ne pouvons proceder Ã  l'inscription.");
}
header('Refresh: 3; URL= index.php');
?>
