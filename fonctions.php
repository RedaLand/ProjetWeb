<?php

	function ConnexionDB() {	
		$host = 'sql2.olympe.in';
		$user = 'username';
		$bdd = 'username';
		$passwd  = 'pass';


		$connect = mysqli_connect($host, $user,$passwd, $bdd) or die("Erreur de connexion au serveur");
		mysqli_set_charset($connect, 'utf8');
		return $connect;
    }

?>