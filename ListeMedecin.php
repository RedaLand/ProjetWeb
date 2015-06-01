<?php require_once('pagesCommunes/header.php'); ?>
<?php include('./fonctions.php'); ?>

  <?php
    $connect = ConnexionDB();   
    $medecins = "SELECT * FROM medecins" or die("Erreur lors de la consultation de données (Medecins)" . mysqli_error($connect));
    $req = $connect->query($medecins);
  ?>

  <div class="container">
    <h2>Medecins</h2>
    <p>Liste de tout les medecins utilisant l'application web. Vous pouvez affiner votre recherche en filtrant selon ce que vous cherchez. Pour cela appuyez sur FILTRER</p>
    <div class="row">
      <div class="panel panel-primary filterable">
          <div class="panel-heading">
              <h3 class="panel-title">Vos medecins</h3>
              <div class="pull-right">
                  <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> FILTRER</button>
              </div>
          </div>        
          <table class="table">
            <thead>
              <tr class="filters">
                <th><input type="text" class="form-control" placeholder="Nom" disabled></th>
                <th><input type="text" class="form-control" placeholder="Prenom" disabled></th>
                <th><input type="text" class="form-control" placeholder="Mail" disabled></th>
                <th><input type="text" class="form-control" placeholder="Specialite" disabled></th>
                <th><input type="text" class="form-control" placeholder="Adresse" disabled></th>
                <th><input type="text" class="form-control" placeholder="Département" disabled></th>
              </tr>
            </thead>
            <tbody class="specialiterchable">
              <?php 
                    while ($row = mysqli_fetch_array($req)) { 
                    $requeteSpecialite = "SELECT Lib_Specialite FROM specialites WHERE ID_Specialites='$row[5]'" or die("Erreur lors de la consultation de données (Specialites)" . mysqli_error($connect));
                    $specialite =  $connect->query($requeteSpecialite);
                    $specialite1 = mysqli_fetch_array($specialite);
              ?>
              <tr>
                <td><?php echo $row[1]; ?></td>
                <td><?php echo $row[2]; ?></td>
                <td><?php echo $row[3]; ?></td>
                <td><?php echo $specialite1[0]; ?></td>
                <td><?php echo $row[8]; ?> <?php echo $row[9]; ?></td>
                <td><?php echo $row[7]; ?></td>                
              </tr>
              <?php } ?>
            </tbody>
          </table>
      </div>
    </div>
  </div>

<?php require_once('pagesCommunes/footer.php'); ?>