<?php 
	include('./session.php');
	$mail = $_POST['mailconnexion'];
	$mdp = $_POST['mdpconnexion'];
	$check = check_auth($mail, $mdp);

if (!empty($mdp) && !empty($mail) && $check)
{
	header('Location: EspaceMedecin.php');
}
else{
	header('Location: index.php');
}
?>