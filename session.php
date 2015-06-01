    <?php

    
    define('INACTIVITY_TIMEOUT',3600); // (in seconds). If the user does not access any page within this time, his/her session is considered expired.
 
     
    function check_auth($mail,$mdp1) 
    {   
        include ("./fonctions.php"); // Connect to the database tuer the file ./fonctions.php
        $connect = ConnexionDB();
        $mdp = md5($mdp1);
        $requetconnexion = "SELECT count(*) FROM medecins WHERE Mail_Medecin='$mail' AND MDP_Medecin='$mdp'" or die("Erreur lors de la consultation de données (Verification check_auth)" . mysqli_error($connect));
        $resultconnexion = $connect->query($requetconnexion);
        $tableau = mysqli_fetch_array($resultconnexion);

        $requetconnexionnom = "SELECT Nom_Medecin FROM medecins WHERE Mail_Medecin='$mail' AND MDP_Medecin='$mdp'" or die("Erreur lors de la consultation de données (Nom Medecin check_auth)" . mysqli_error($connect));
        $resultconnexion1 = $connect->query($requetconnexionnom);
        $tableau1 = mysqli_fetch_array($resultconnexion1);

        if ($tableau[0]==1)
        {

            $Supprsession = "DELETE FROM ci_sessions WHERE Mail_Session='$mail'" or die("Erreur lors de la consultation de données (Suppression session dans check auth)" . mysqli_error($connect));
            $SupprSessionCheckAuth = $connect->query($Supprsession);
            unset($_COOKIE['sessionCookie'][ID]);
            unset($_COOKIE['sessionCookie'][Mail]);
            unset($_COOKIE['sessionCookie'][User]);
            $uniqueId = md5(sha1(uniqid('',true).'_'.mt_rand())); // generate unique random number (different than phpsessionid)
            $sessionExpiration =time()+INACTIVITY_TIMEOUT;  // Set session expiration.
            $sessionNomUser =$tableau1[0];
            setCookie('sessionCookie[ID]',$uniqueId, $sessionExpiration);
            setCookie('sessionCookie[Mail]',$mail, $sessionExpiration);
            setCookie('sessionCookie[User]',$sessionNomUser, $sessionExpiration);
            $insertionsession = "INSERT INTO ci_sessions (session_id, Mail_Session, last_activity) VALUES ('$uniqueId', '$mail', '$sessionExpiration')" or die("Erreur lors de la consultation de données (Insertion session)" . mysqli_error($connect));
            $insert = $connect->query($insertionsession);
            return True;
        }
        else
        {
            return False;

        }
    }
     
    function check_login()
    // Fonction pour etre sur que mon utilisateur est connecte sinon je logout ce qui envoie vers index
    {
        $ancienID = $_COOKIE['sessionCookie'][ID]; // Je récupere l'ancien ID pour l'update de la table session (Il va etre changé par précaution)
        $ancienMAIL = $_COOKIE['sessionCookie'][Mail]; // Je récupere l'ancien Mail également
        $UserName = $_COOKIE['sessionCookie'][User]; // Récup non d'user
        $host = 'sql2.olympe.in';
        $user = 'username';
        $bdd = 'username';
        $passwd  = 'pass';


        $connect = mysqli_connect($host, $user,$passwd, $bdd) or die("Erreur de connexion au serveur");
        mysqli_set_charset($connect, 'utf8');
        $requeteVerifSession = "SELECT count(*) FROM ci_sessions WHERE session_id='$ancienID' AND Mail_Session='$ancienMAIL'" or die("Erreur lors de la consultation de données (Verif session)" . mysqli_error($connect));
        $ResRequeteVerifSession = $connect->query($requeteVerifSession);
        $tableauRes = mysqli_fetch_array($ResRequeteVerifSession); //  Si mes cookie sont rempli et que les info dedans corréspondent bien à ce qu'il y a dans ma base de donnée  

        if ($tableauRes[0]==1) 
        {
            $sessionExpiration1 =time()+INACTIVITY_TIMEOUT;  // L'utilisateur a rafraichi une page donc il est "actif" on lui rajoute une heure d'activité
            setCookie('sessionCookie[ID]',$ancienID , $sessionExpiration1); // On actualise les cookies
            setCookie('sessionCookie[Mail]',$ancienMAIL, $sessionExpiration1); // On actualise les cookies
            setCookie('sessionCookie[User]',$UserName, $sessionExpiration1); // On actualise les cookies
            $updatesession = "UPDATE ci_sessions SET last_activity = '$sessionExpiration1' WHERE session_id = '$ancienID'" or die("Erreur lors de la consultation de données (Update session)" . mysqli_error($connect));
            $Update = $connect->query($updatesession); // On actualise la base de donnée table session
            return True; // Et je dit que ça s'est bien passé
        }

        else // Sinon
        {
            // return False; // Et je dit que ça s'est mal passé
            header('Location: index.php'); // C'est que mon utilisateur n'est pas le bon ou qu'il a supprimé ses cookies etc.. Par précaution je force la déconnexion

        }

    }

    function logout()
    // On force la déconnexion et on redirige sur la page d'accueil 
    {

        $host = 'sql2.olympe.in';
        $user = 'username';
        $bdd = 'username';
        $passwd  = 'pass';


        $connect = mysqli_connect($host, $user,$passwd, $bdd) or die("Erreur de connexion au serveur");
        mysqli_set_charset($connect, 'utf8');
        $ancienMailSuppr = $_COOKIE['sessionCookie'][Mail]; // Je récupere l'ancien Mail pour la suppresion de session de la table session (Il va être vidé par la suite)
        setCookie('sessionCookie[ID]','', time() - 3600 );
        setCookie('sessionCookie[Mail]','', time() - 3600);
        setCookie('sessionCookie[User]','', time() - 3600);
        unset($_COOKIE['sessionCookie'][ID]);
        unset($_COOKIE['sessionCookie'][Mail]);
        unset($_COOKIE['sessionCookie'][User]);
        $supprimersession = "DELETE FROM ci_sessions WHERE Mail_Session = '$ancienMailSuppr'" or die("Erreur lors de la consultation de données (Suppresion session)" . mysqli_error($connect));
        $Supprime = $connect->query($supprimersession); // On actualise la base de donnée table session

        header('Location: index.php');
        exit();
        // Je vide puis supprime les cookie même si cela n'est pas réellement necessaire puisque ma table coté serveur aura été vidée

    }
     
    ?>

