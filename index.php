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
        <a href="#" class="navbar-brand">Home</a>
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
          <li><a id="clickme" href="http://followup.olympe.in/EspaceMedecin.php">Info patients</a></li>
          <li><a href="http://followup.olympe.in/SupprimerPatient.php">Supprimer Patient</a></li>
        </ul>
        <ul class="navbar-right navbar-brand" id="CacheSiLogin">
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
    
  <!-- POP UP CONNEXION MODAL -->
  <div id="loginModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h1 class="text-center">Login</h1>
        </div>
        <div class="modal-body">
          <form class="form col-md-12 center-block" action="/Connexion.php" method="POST">
            <fieldset>
            <div class="form-group">
              <input type="text" class="form-control input-lg" type=text id="mailconnexion" name="mailconnexion" placeholder="Votre adresse mail">
            </div>
            <div class="form-group">
              <input type="password" class="form-control input-lg" type=password id="mdpconnexion" name="mdpconnexion" placeholder="Votre mot de passe">
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block">Se connecter</button>
              <span class="pull-right"><a href="http://followup.olympe.in/NouvelleInscription.php">S'enregistrer</a></span><span><a href="#">Need help?</a></span>
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

  <div id="idModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h1 class="text-center">Retrouvez votre ID</h1>
        </div>
        <div class="modal-body">
          <form class="form col-md-12 center-block" action="/monId.php" method="POST">
            <fieldset>
            <div class="form-group">
              <input type="text" class="form-control input-lg" id="nompatient" name="nompatient" placeholder="Votre nom">
            </div>
            <div class="form-group">
              <input type="email" class="form-control input-lg" id="mailpatient" name="mailpatient" placeholder="Votre adresse mail">
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block">Quel est mon ID?</button>
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



  
    <div class="row">
      <div class="col-md-6 col-md-offset-3 text-center">
        <h3 id = "cookieUser">Bienvenue <?php print $_COOKIE['sessionCookie']['User']; ?></h3>
        <br>
      </div>
    </div>
  
    <div class="row">
      <div id="jeSuisMedecin" class="col-sm-4 col-sm-offset-2">
           <div class="panel panel-default">
           <div class="panel-heading text-center"><h2><i class="icon-chevron-left"></i> Je suis médecin</h2></div>
              <div class="row">&nbsp;</div>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#loginModal">Se connecter</button>
   
           </div>
      </div>
      <div id="jeSuisPatient" class="col-sm-4">
           <div class="panel panel-default">
           <div class="panel-heading text-center"><h2>Je suis patient <i class="icon-chevron-right"></i></h2></div>
             <div class="row">&nbsp;</div>
            <button type="button" class="btn btn-lg btn-primary btn-block" data-toggle="modal" data-target="#idModal">Connaitre mon ID</button> 
           </div>
      </div>
    </div>


    <footer>
    <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3 text-center">
        <ul class="list-inline">
          <li><i class="icon-facebook icon-2x"></i></li>
          <li><i class="icon-twitter icon-2x"></i></li>
          <li><i class="icon-google-plus icon-2x"></i></li>
          <li><i class="icon-pinterest icon-2x"></i></li>
        </ul>
        <hr>
        <p>Built <i class="icon-heart-empty"></i> by <a href="http://www.facebook.com/Redaland">Reda</a>.<br>©2015</p>
      </div>
    </div>
    </div>
    </footer>
  </div>

  <ul class="nav pull-right scroll-down">
    <li><a href="#" title="Scroll down"><i class="icon-chevron-down icon-3x"></i></a></li>
  </ul>
  <ul class="nav pull-right scroll-top">
    <li><a href="#" title="Scroll to top"><i class="icon-chevron-up icon-3x"></i></a></li>
  </ul>

  <!-- script references -->
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    <script src="http://followup.olympe.in/js/main.js"></script>
    <script src="http://followup.olympe.in/js/scripts.js"></script>    
    <script src="http://followup.olympe.in/js/ajaxform.js"></script> 
    <script type="text/javascript">
        window.onload = function () {
            if(document.cookie.length > 0){
            document.getElementById("jeSuisMedecin").setAttribute("class", "ClassThatHides");
            document.getElementById("jeSuisPatient").setAttribute("class", "col-sm-4 col-sm-offset-4");
            }
        };

    </script>


  </body>
</html>