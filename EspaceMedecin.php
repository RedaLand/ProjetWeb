<?php include ('./session.php'); check_login(); ?>
<?php require_once('pagesCommunes/header.php'); ?>

  <form id="formulaireGetPatient" action="RecupererDossier.php" method="post">
    <h1 class="text-center">Dossier du patient</h1>
    <div class="form col-md-6 col-md-offset-3">
        <input type="text" class="form-control input-lg" id="numPatient"  onkeydown="verifNumPatient()" name="numPatient" placeholder="Votre num patient">
        <span id="NumPatientInnexact"></span>
        <span><br></br></span>
        <button class="btn btn-primary btn-lg btn-block" type="submit" name='submit' value='Submit'>Sortir le dossier</button>
        <span class="pull-right"><a href="http://followup.olympe.in/ListeMedecin.php">Liste des patients</a></span><span><a href="#">Need help?</a></span>
    </div>
  </form>

<?php require_once('pagesCommunes/footer.php'); ?>


<script type="text/javascript">

  // document.forms["formulaireGetPatient"].style.display="block";
  var f=document.forms["formulaireGetPatient"].elements;

  function verifNumPatient(){ 
  	var regNumPatient = new RegExp('^[0-9]+$','i');
    var identifiant= f['numPatient'].value;
    if (!regNumPatient.test(f['numPatient'].value)){
	document.getElementById("NumPatientInnexact").innerHTML = "Numéro patient invalide ! Exemple valide : 123456";
    }
    else if(numPatient != ''){
       $.post('/checkPatient.php',{ identifiant: identifiant}, function(data) {
       $('#NumPatientInnexact').text(data);
       $('#NumPatientInnexact').text(data);
       });
    }
  }
</script>