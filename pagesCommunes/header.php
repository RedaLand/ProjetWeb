<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Bootstrap REDA</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
  </head>



  <body>

	<div class="navbar navbar-fixed-top alt" data-spy="affix" data-offset-top="1000">
	<div class="container">
	  <div class="navbar-header">
	    <a href="http://followup.olympe.in/index.php" class="navbar-brand">Home</a>
	    <a class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	      <span class="icon-bar"></span>
	      <span class="icon-bar"></span>
	      <span class="icon-bar"></span>
	    </a>
	  </div>
	  <div class="navbar-collapse collapse" id="navbar">
	    <ul class="nav navbar-nav">
	      <li><a href="http://followup.olympe.in/ListeMedecin.php">Liste de medecins</a></li>
	      <li><a href="http://followup.olympe.in/NouvelleInscription.php">Inscription médecin</a></li>
	      <li><a href="http://followup.olympe.in/EspaceMedecin.php">Info patients</a></li>
	      <li><a href="http://followup.olympe.in/SupprimerPatient.php">Supprimer Patient</a></li>
	    </ul>
        <ul class="navbar-right navbar-brand" >
			  <button class="btn btn-primary" data-toggle="modal" data-target="#logoutModal">Logout</button>
            </button>
        </ul>
	  </div>
	</div>
	</div>


		<!-- Modal de déconnexion -->

		<div id="logoutModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		  <div class="modal-dialog modal-sm">
		    <div class="modal-content">
		      <div class="modal-header"><h4>Logout <i class="fa fa-lock"></i></h4></div>
		      <div class="modal-body"><i class="fa fa-question-circle"></i> Etes vous sur de vouloir vous déconnecter?</div>
		      <div class="modal-footer"><a href="http://followup.olympe.in/Logout.php" class="btn btn-primary btn-block">Logout</a></div>
		    </div>
		  </div>
		</div>

	<div class="blurb bright">
