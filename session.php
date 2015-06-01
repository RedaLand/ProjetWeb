    <?php

    
    define('INACTIVITY_TIMEOUT',3600); // (in seconds). If the user does not access any page within this time, his/her session is considered expired.
 
     
    function check_auth($mail,$mdp1) 
    {   
        include ("./fonctions.php"); // Connect to the database tuer the file ./fonctions.php
        $connect = ConnexionDB();
        $mdp = md5($mdp1);
        $requetconnexion = "SELECT count(*) FROM medecins WHERE Mail_Medecin='$mail' AND MDP_Medecin='$mdp'" or die("Erreur lors de la consultation de donn�es (Verification check_auth)" . mysqli_error($connect));
        $resultconnexion = $connect->query($requetconnexion);
        $tableau = mysqli_fetch_array($resultconnexion);

        $requetconnexionnom = "SELECT Nom_Medecin FROM medecins WHERE Mail_Medecin='$mail' AND MDP_Medecin='$mdp'" or die("Erreur lors de la consultation de donn�es (Nom Medecin check_auth)" . mysqli_error($connect));
        $resultconnexion1 = $connect->query($requetconnexionnom);
        $tableau1 = mysqli_fetch_array($resultconnexion1);

        if ($tableau[0]==1)
        {

            $Supprsession = "DELETE FROM ci_sessions WHERE Mail_Session='$mail'" or die("Erreur lors de la consultation de donn�es (Suppression session dans check auth)" . mysqli_error($connect));
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
            $insertionsession = "INSERT INTO ci_sessions (session_id, Mail_Session, last_activity) VALUES ('$uniqueId', '$mail', '$sessionExpiration')" or die("Erreur lors de la consultation de donn�es (Insertion session)" . mysqli_error($connect));
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
        $ancienID = $_COOKIE['sessionCookie'][ID]; // Je r�cupere l'ancien ID pour l'update de la table session (Il va etre chang� par pr�caution)
        $ancienMAIL = $_COOKIE['sessionCookie'][Mail]; // Je r�cupere l'ancien Mail �galement
        $UserName = $_COOKIE['sessionCookie'][User]; // R�cup non d'user
        $host = 'sql2.olympe.in';
        $user = 'username';
        $bdd = 'username';
        $passwd  = 'pass';


        $connect = mysqli_connect($host, $user,$passwd, $bdd) or die("Erreur de connexion au serveur");
        mysqli_set_charset($connect, 'utf8');
        $requeteVerifSession = "SELECT count(*) FROM ci_sessions WHERE session_id='$ancienID' AND Mail_Session='$ancienMAIL'" or die("Erreur lors de la consultation de donn�es (Verif session)" . mysqli_error($connect));
        $ResRequeteVerifSession = $connect->query($requeteVerifSession);
        $tableauRes = mysqli_fetch_array($ResRequeteVerifSession); //  Si mes cookie sont rempli et que les info dedans corr�spondent bien � ce qu'il y a dans ma base de donn�e  

        if ($tableauRes[0]==1) 
        {
            $sessionExpiration1 =time()+INACTIVITY_TIMEOUT;  // L'utilisateur a rafraichi une page donc il est "actif" on lui rajoute une heure d'activit�
            setCookie('sessionCookie[ID]',$ancienID , $sessionExpiration1); // On actualise les cookies
            setCookie('sessionCookie[Mail]',$ancienMAIL, $sessionExpiration1); // On actualise les cookies
            setCookie('sessionCookie[User]',$UserName, $sessionExpiration1); // On actualise les cookies
            $updatesession = "UPDATE ci_sessions SET last_activity = '$sessionExpiration1' WHERE session_id = '$ancienID'" or die("Erreur lors de la consultation de donn�es (Update session)" . mysqli_error($connect));
            $Update = $connect->query($updatesession); // On actualise la base de donn�e table session
            return True; // Et je dit que �a s'est bien pass�
        }

        else // Sinon
        {
            // return False; // Et je dit que �a s'est mal pass�
            header('Location: index.php'); // C'est que mon utilisateur n'est pas le bon ou qu'il a supprim� ses cookies etc.. Par pr�caution je force la d�connexion

        }

    }

    function logout()
    // On force la d�connexion et on redirige sur la page d'accueil 
    {

        $host = 'sql2.olympe.in';
        $user = 'username';
        $bdd = 'username';
        $passwd  = 'pass';


        $connect = mysqli_connect($host, $user,$passwd, $bdd) or die("Erreur de connexion au serveur");
        mysqli_set_charset($connect, 'utf8');
        $ancienMailSuppr = $_COOKIE['sessionCookie'][Mail]; // Je r�cupere l'ancien Mail pour la suppresion de session de la table session (Il va �tre vid� par la suite)
        setCookie('sessionCookie[ID]','', time() - 3600 );
        setCookie('sessionCookie[Mail]','', time() - 3600);
        setCookie('sessionCookie[User]','', time() - 3600);
        unset($_COOKIE['sessionCookie'][ID]);
        unset($_COOKIE['sessionCookie'][Mail]);
        unset($_COOKIE['sessionCookie'][User]);
        $supprimersession = "DELETE FROM ci_sessions WHERE Mail_Session = '$ancienMailSuppr'" or die("Erreur lors de la consultation de donn�es (Suppresion session)" . mysqli_error($connect));
        $Supprime = $connect->query($supprimersession); // On actualise la base de donn�e table session

        header('Location: index.php');
        exit();
        // Je vide puis supprime les cookie m�me si cela n'est pas r�ellement necessaire puisque ma table cot� serveur aura �t� vid�e

    }
     
    ?>

