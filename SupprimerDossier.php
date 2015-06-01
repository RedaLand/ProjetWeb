<?php include ('./session.php'); check_login(); ?> 
<?php require_once('pagesCommunes/header.php'); ?>

<?php include('./fonctions.php'); ?>


<?php $id = $_POST['numPatient']; ?>


<?php
	$connect = ConnexionDB(); // Je me connecte à la base de donnée

	$supprimerDossier = "DELETE FROM patients WHERE Numero_Piece_ID = '$id'" or die("Erreur lors de la consultation de données (Suppresion patient)" . mysqli_error($connect));
	$Supprime = $connect->query($supprimerDossier); // On actualise la base de donnée table patient
    header('Location: EspaceMedecin.php');
?>