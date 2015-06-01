<?php include ('./session.php'); check_login(); ?>
<!-- Cette page ne doit etre accessible que l'utilisateur est connecté
Ensuite j'appelle le header avec ce script -->
<?php require_once('pagesCommunes/header.php'); ?>
<!-- Puis le fichier contenant les fonctions notamant pour la fonction connexion() histoire d'eviter d'avoir les variables de connexion qui trainent -->
<?php include('./fonctions.php'); ?>
<!-- Je récupere le numéro du patient à partir du formulaire d'avant -->
<?php if(!empty($_GET['numPatient'])){$id=$_GET['numPatient'];}else{$id = $_POST['numPatient'];}?>
<!-- Et le medecin à partir du cookie -->
<?php $medecinNom = $_COOKIE['sessionCookie'][User]; ?>
<?php $medecinMail = $_COOKIE['sessionCookie'][Mail]; ?>

<?php
      $connect = ConnexionDB(); // Je me connecte à la base de donnée

      $IDMedecin = "SELECT ID_Medecin FROM medecins WHERE Mail_Medecin='$medecinMail'" or die("Erreur lors de la consultation de données (Verif ID)" . mysqli_error($connect));
      $ListeID = $connect->query($IDMedecin);
      $IDMedecinFinal = mysqli_fetch_array($ListeID);    

      $requeteOrdonnace = "SELECT Date_Edition_Ordonnance, Remarque_Ordonnance, ID_Medecin, LienPhoto, Num_Ordonnance FROM ordonnances WHERE Numero_Piece_ID=$id" or die("Erreur lors de la consultation de données (Ordonnaces)" . mysqli_error($connect));
      $listeOrdonnances = $connect->query($requeteOrdonnace); // Je récupere les ordonnances du Mr
      $requeteAntecedant = "SELECT Type_Antecedant, Remarque_Antecedant, Secret_Antecedant, ID_Medecin FROM antecedants WHERE (ID_Patient=$id AND Secret_Antecedant='False') OR (ID_Patient=$id AND ID_Medecin=$IDMedecinFinal[0])" or die("Erreur lors de la consultation de données (Ordonnaces)" . mysqli_error($connect));
      $listeAntecedants = $connect->query($requeteAntecedant); // Puis les antecedants
      $espace=" "; 
  ?>


    <div class="container col-lg-6">
      <h2>Liste des ordonnances</h2>
      <p>Liste de toutes les ordonnaces du patient No: <?php echo $id; ?></p>
      <div class="row">
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Ordonnaces</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> FILTRER</button>
                </div>
            </div>        
      <table class="table">
        <thead>
          <tr class="filters">
            <th><input type="text" class="form-control" placeholder="Date" disabled></th>
            <th><input type="text" class="form-control" placeholder="Contenu (ou lien)" disabled></th>
            <th><input type="text" class="form-control" placeholder="Medecin éditeur" disabled></th>
          </tr>
        </thead>
        <tbody class="specialiterchable">
          <?php 
                while ($row = mysqli_fetch_array($listeOrdonnances)) { 
                $RequeteNomMedein = "SELECT Prenom_Medecin, Nom_Medecin FROM medecins WHERE ID_Medecin=$row[2]" or die("Erreur lors de la consultation de données (NomMedecins)" . mysqli_error($connect));
                $NomMed = $connect->query($RequeteNomMedein);  // Ici on transforme l'ID du médecin récupéré en Nom et Prenom
                $ListNomMedecins = mysqli_fetch_array($NomMed);
                $imageSource = $row[3];
          ?>
          <tr>
            <td><?php echo $row[0]; ?></td>
            <!-- La ligne suivante contiendra soit le lien vers une photo d'ordonnance soit l'ordonnance écrite directement par le medecin d'ou le if(is_null()) qui vérifie justement si c'est une photo ou un texte -->
            <!-- Ceci est possible car nous savons qu'une ordonnance est SOIT une photo d'ordonnance SOIT un texte écrit à la main -->
            <td data-toggle="modal" data-target="#imagemodal<?php echo $row[4]; ?>"><a href="#"><?php if (is_null($row[1])){echo $imageSource;} else{echo $row[1];}; ?></a></td>
            <!-- Nom et prenom du medecin qui a édité l'ordonnance -->
            <td><?php echo $ListNomMedecins[0], $espace, $ListNomMedecins[1]; ?></td>
          </tr>

              <!-- Le modal ou la photo va apparaitre quand l'user va cliquer sur le lien -->
              <div class="modal fade" id="imagemodal<?php echo $row[4]; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span></button>
                      <h4 class="modal-title" >Ordonnance scannée</h4>
                    </div>
                    <?php if(is_null($row[1])){
                    echo '<div class="modal-body">
                      <img id="imagepreview" style="width: 500px; height: 664px;" src="';echo $imageSource;
                    echo '">
                    </div>'; } ?>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- FIN DU MODAL PHOTO  -->
          <?php } ?>
        </tbody>
        <tfoot>
          <tr class="filters">
            <th></th>
            <th><button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalajoutordonnance">Ajouter une ordonnance</button></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
  </div>

    <div class="container col-lg-6">
      <h2>Antecedants médicaux</h2>
      <p>Tous les antécedants médicaux du patient No: <?php echo $id; ?> qui ne relevent pas du secret ou écrits par vous.</p>
      <div class="row">
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Antecedants</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> FILTRER</button>
                </div>
            </div>        
      <table class="table">
        <thead>
          <tr class="filters">
            <th><input type="text" class="form-control" placeholder="Type" disabled></th>
            <th><input type="text" class="form-control" placeholder="Contenu" disabled></th>
            <th><input type="text" class="form-control" placeholder="Medecin éditeur" disabled></th>
            <th><input type="text" class="form-control" placeholder="Secret médical" disabled></th>
          </tr>
        </thead>
        <tbody class="specialiterchable">
          <?php 
                while ($row1 = mysqli_fetch_array($listeAntecedants)) { 
                $RequeteNomMedein1 = "SELECT Prenom_Medecin, Nom_Medecin FROM medecins WHERE ID_Medecin=$row1[3]" or die("Erreur lors de la consultation de données (NomMedecins)" . mysqli_error($connect));
                $NomMed1 = $connect->query($RequeteNomMedein1);
                $ListNomMedecins1 = mysqli_fetch_array($NomMed1);
          ?>
          <tr>
            <td><?php echo $row1[0]; ?></td>
            <td><?php echo $row1[1]; ?></td>
            <td><?php echo $ListNomMedecins1[0], $espace, $ListNomMedecins1[1]; ?></td>
            <td><?php echo $row1[2]; ?></td>
          </tr>
          <?php } ?>
        </tbody>
        <tfoot>
          <tr class="filters">
            <th></th>
            <th><button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalajoutantecedant">Ajouter un antecedant</button></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
  </div>



      <!-- POP UP MON ID MODAL -->

      <div id="modalajoutordonnance" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h1 class="text-center">Ajouter une ordonnance</h1>
            </div>
            <div class="modal-body">
              <form class="form col-md-12 center-block" action="/AjouterOrdonnance.php" method="POST">
                <fieldset>
                <div class="form-group">
                  <input type="text" class="form-control input-lg" id="remarqueordonnance" name="remarqueordonnance" placeholder="Votre ordonnance écrite ici (Si pas de photo)">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control input-lg" id="lienordonnance" name="lienordonnance" placeholder="Ou un lien photo ici ! (Si pas de remarque)">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control input-lg" id="medecinordonnance" name="medecinordonnance" placeholder="Le medecin" value="<?php echo $medecinMail ?>" readonly>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control input-lg" id="patientordonnance" name="patientordonnance" value="<?php echo $id ?>" readonly>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary btn-lg btn-block">Ajouter cette ordonnance</button>
                  <span class="pull-right"><a href="#"></a></span><span><a href="#">Need help?</a></span>
                </div>
                </fieldset>
              </form>
            </div>
            <div class="modal-footer">
              <div class="col-md-12">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
              </div>  
            </div>
          </div>
        </div>
      </div>


      <!-- POP UP MON ID MODAL -->

      <div id="modalajoutantecedant" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h1 class="text-center">Ajouter un antecedant</h1>
            </div>
            <div class="modal-body">
              <form class="form col-md-12 center-block" action="/AjouterAntecedant.php" method="POST">
                <fieldset>
                <div class="form-group">
                  <input type="text" class="form-control input-lg" id="typeantecedant" name="typeantecedant" placeholder="Le type de l'antecedant !">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control input-lg" id="remarqueantecedant" name="remarqueantecedant" placeholder="Votre antecedant écrit ici">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control input-lg" id="medecinantecedant" name="medecinantecedant" placeholder="<?php echo $medecinMail ?>" value="<?php echo $medecinMail ?>" readonly>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control input-lg" id="patientantecedant" name="patientantecedant" value="<?php echo $id ?>" readonly>
                </div>
                <div class="form-group">
                  <label><input type="checkbox" class="checkbox" id="secretmedical" name="secretmedical" value="True">Secret médical</label>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary btn-lg btn-block">Ajouter cet antecedant</button>
                  <span class="pull-right"><a href="#"></a></span><span><a href="#">Need help?</a></span>
                </div>
                </fieldset>
              </form>
            </div>
            <div class="modal-footer">
              <div class="col-md-12">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
              </div>  
            </div>
          </div>
        </div>
      </div>



<?php require_once('pagesCommunes/footer.php'); ?>
