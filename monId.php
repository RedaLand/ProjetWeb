<?php require_once('pagesCommunes/header.php'); ?>
<?php include('./fonctions.php'); ?>

    <?php
      $nom = $_POST['nompatient'];
      $mail = $_POST['mailpatient'];

      $connect = ConnexionDB(); // Je me connecte à la base de donnée

      $IDPatient = "SELECT Numero_Piece_ID FROM patients WHERE (Mail_Patient='$mail') OR (Nom_Patients='$nom')" or die("Erreur lors de la consultation de données (Verif ID)" . mysqli_error($connect));
      $ListeID = $connect->query($IDPatient);
      $IDPatientFinal = mysqli_fetch_array($ListeID);
    ?>
    <div class="row">
      <div class="col-md-6 col-md-offset-3 text-center">
        <h3 id = "cookieUser">Votre identifiant <?php echo $IDPatientFinal[0]; ?></h3>
        <br>
      </div>
    </div>
<?php require_once('pagesCommunes/footer.php'); ?>
