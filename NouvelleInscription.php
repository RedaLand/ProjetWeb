<?php require_once('pagesCommunes/header.php'); ?>

<form id="formulaireinscription" action="Inserer.php" method="post">
    <section class="container">
    <div class="container-page">        
      <div class="col-md-6">
        <h3 class="dark-grey">Registration</h3>
        
        <div class="form-group col-lg-6 ">
          <label>Nom</label>
          <input type="text" name="nom" class="form-control" id="nom" value="" placeholder="Votre nom">
        </div>
                
        <div class="form-group col-lg-6 ">
          <label>Prenom</label>
          <input type="text" name="prenom" class="form-control" id="prenom" value="" placeholder="Votre prenom">
        </div>    

        <div class="form-group col-lg-6">
          <label>Password</label>
          <input type="password" name="mdp" class="form-control" id="mdp" placeholder="Choisissez un mot de passe">
        </div>
        
        <div class="form-group col-lg-6">
          <label>Repeat Password</label>
          <input type="password" name="mdp2" class="form-control" id="mdp2" placeholder="Le même mot de passe">
        </div>

                
        <div class="form-group col-lg-6">
          <label>Email Address</label>
          <input type="email" name="mail" class="form-control" onkeyup="verifMail()" id="mail" placeholder="toto@tata.fr">
          <span id="maildejapris"></span>
        </div>
        
        <div class="form-group col-lg-6">
          <label>Repeat Email Address</label>
          <input type="email" name="mail2" class="form-control" onkeyup="verifMail()" id="mail2" placeholder="La même adresse">
          <span id="maildejapris1"></span>
        </div>      

        <div class="form-group col-lg-6 ">
          <label class="control-label col-lg-12" for="specialite">Votre spécialité</label>
          <div class="col-sm-6 col-md-4 col-lg-10">
            <select id="specialite" class="form-control" name="specialite">
              <option><a href="#" value="1">Cardiologue</a></option>
              <option><a href="#" value="2">Dermatologue</a></option>
              <option><a href="#" value="3">Endoctrinologue</a></option>
              <option><a href="#" value="4">Gynécologue</a></option>
              <option><a href="#" value="5">Généraliste</a></option>
              <option><a href="#" value="6">Neurologue</a></option>
              <option><a href="#" value="7">Dentiste</a></option>
              <option><a href="#" value="8">Pédiatre</a></option>
              <option><a href="#" value="9">Pneumologue</a></option>
              <option><a href="#" value="10">Psychiatre</a></option>
              <option><a href="#" value="11">Rhumatologue</a></option>
              <option><a href="#" value="12">Orthophoniste</a></option>
            </select> 
          </div>
        </div> 
                
        <div class="form-group col-lg-6">
          <label class="control-label col-lg-12" for="departement">Département du cabinet</label>
          <div class="col-sm-6 col-md-4 col-lg-10">
            <select id="departement" class="form-control" name="departement">
                  <option><a href="#" value="01">01  Ain</a></option>
                  <option><a href="#" value="02">02  Aisne</a></option>
                  <option><a href="#" value="03">03  Allier</a></option>
                  <option><a href="#" value="04">04  Alpes</a></option>
                  <option><a href="#" value="05">05  Hautes-Alpes</a></option>
                  <option><a href="#" value="06">06  Alpes-Maritimes</a></option>
                  <option><a href="#" value="07">07  Ardèche</a></option>
                  <option><a href="#" value="08">08  Ardennes</a></option>
                  <option><a href="#" value="09">09  Ariège</a></option>
                  <option><a href="#" value="10">10  Aube</a></option>
                  <option><a href="#" value="11">11  Aude</a></option>
                  <option><a href="#" value="12">12  Aveyron</a></option>
                  <option><a href="#" value="13">13  Bouches-du-Rhône</a></option>
                  <option><a href="#" value="14">14  Calvados</a></option>
                  <option><a href="#" value="15">15  Cantal</a></option>
                  <option><a href="#" value="16">16  Charente</a></option>
                  <option><a href="#" value="17">17  Charente-Maritime</a></option>
                  <option><a href="#" value="18">18  Cher</a></option>
                  <option><a href="#" value="19">19  Corrèze</a></option>
                  <option><a href="#" value="21">21  Côte-d'Or</a></option>
                  <option><a href="#" value="22">22  Côtes d'Armor</a></option>
                  <option><a href="#" value="23">23  Creuse</a></option>
                  <option><a href="#" value="24">24  Dordogne</a></option>
                  <option><a href="#" value="25">25  Doubs</a></option>
                  <option><a href="#" value="26">26  Drôme</a></option>
                  <option><a href="#" value="27">27  Eure</a></option>
                  <option><a href="#" value="28">28  Eure-et-Loir</a></option>
                  <option><a href="#" value="29">29  Finistère</a></option>
                  <option><a href="#" value="30">30  Gard</a></option>
                  <option><a href="#" value="31">31  Haute-Garonne</a></option>
                  <option><a href="#" value="32">32  Gers</a></option>
                  <option><a href="#" value="33">33  Gironde</a></option>
                  <option><a href="#" value="34">34  Hérault</a></option>
                  <option><a href="#" value="35">35  Ille-et-Vilaine</a></option>
                  <option><a href="#" value="36">36  Indre</a></option>
                  <option><a href="#" value="37">37  Indre-et-Loire</a></option>
                  <option><a href="#" value="38">38  Isère</a></option>
                  <option><a href="#" value="39">39  Jura</a></option>
                  <option><a href="#" value="40">40  Landes</a></option>
                  <option><a href="#" value="41">41  Loir-et-Cher</a></option>
                  <option><a href="#" value="42">42  Loire</a></option>
                  <option><a href="#" value="43">43  Haute-Loire</a></option>
                  <option><a href="#" value="44">44  Loire-Atlantique</a></option>
                  <option><a href="#" value="45">45  Loiret</a></option>
                  <option><a href="#" value="46">46  Lot</a></option>
                  <option><a href="#" value="47">47  Lot-et-Garonne</a></option>
                  <option><a href="#" value="48">48  Lozère</a></option>
                  <option><a href="#" value="49">49  Maine-et-Loire</a></option>
                  <option><a href="#" value="50">50  Manche</a></option>
                  <option><a href="#" value="51">51  Marne</a></option>
                  <option><a href="#" value="52">52  Haute-Marne</a></option>
                  <option><a href="#" value="53">53  Mayenne</a></option>
                  <option><a href="#" value="54">54  Meurthe-et-Moselle</a></option>
                  <option><a href="#" value="55">55  Meuse</a></option>
                  <option><a href="#" value="56">56  Morbihan</a></option>
                  <option><a href="#" value="57">57  Moselle</a></option>
                  <option><a href="#" value="58">58  Nièvre</a></option>
                  <option><a href="#" value="59">59  Nord</a></option>
                  <option><a href="#" value="60">60  Oise</a></option>
                  <option><a href="#" value="61">61  Orne</a></option>
                  <option><a href="#" value="62">62  Pas-de-Calais</a></option>
                  <option><a href="#" value="63">63  Puy-de-Dôme</a></option>
                  <option><a href="#" value="64">64  Pyrénées-Atlantiques</a></option>
                  <option><a href="#" value="65">65  Hautes-Pyrénées</a></option>
                  <option><a href="#" value="66">66  Pyrénées-Orientales</a></option>
                  <option><a href="#" value="67">67  Bas-Rhin</a></option>
                  <option><a href="#" value="68">68  Haut-Rhin</a></option>
                  <option><a href="#" value="69">69  Rhône</a></option>
                  <option><a href="#" value="70">70  Haute-Saône</a></option>
                  <option><a href="#" value="71">71  Saône-et-Loire</a></option>
                  <option><a href="#" value="72">72  Sarthe</a></option>
                  <option><a href="#" value="73">73  Savoie</a></option>
                  <option><a href="#" value="74">74  Haute-Savoie</a></option>
                  <option><a href="#" value="75">75  Paris</a></option>
                  <option><a href="#" value="76">76  Seine-Maritime</a></option>
                  <option><a href="#" value="77">77  Seine-et-Marne</a></option>
                  <option><a href="#" value="78">78  Yvelines</a></option>
                  <option><a href="#" value="79">79  Deux-Sèvres</a></option>
                  <option><a href="#" value="80">80  Somme</a></option>
                  <option><a href="#" value="81">81  Tarn</a></option>
                  <option><a href="#" value="82">82  Tarn-et-Garonne</a></option>
                  <option><a href="#" value="83">83  Var</a></option>
                  <option><a href="#" value="84">84  Vaucluse</a></option>
                  <option><a href="#" value="85">85  Vendée</a></option>
                  <option><a href="#" value="86">86  Vienne</a></option>
                  <option><a href="#" value="87">87  Haute-Vienne</a></option>
                  <option><a href="#" value="88">88  Vosges</a></option>
                  <option><a href="#" value="89">89  Yonne</a></option>
                  <option><a href="#" value="90">90  Territoire-de-Belfort</a></option>
                  <option><a href="#" value="91">91  Essonne</a></option>
                  <option><a href="#" value="92">92  Hauts-de-Seine</a></option>
                  <option><a href="#" value="93">93  Seine-Saint-Denis</a></option>
                  <option><a href="#" value="94">94  Val-de-Marne</a></option>
                  <option><a href="#" value="95">95  Val-d'Oise</a></option>
           </select> 
          </div>
        </div>   

        <div class="form-group col-lg-3">
          <label>Numéro rue</label>
          <input type="text" name="numrue" class="form-control" id="numrue" value="" placeholder="Ex: 123">
        </div>
        <div class="form-group col-lg-3">
          <label>Rue cabinet</label>
          <input type="text" name="nomrue" class="form-control" id="nomrue" value="" placeholder="Rue de l'exemple">
        </div>
        
        <div class="form-group col-lg-6">
          <label>Date de naissance JJ/MM/AAAA</label>
          <input type="date" name="datenaissance" class="form-control" id="datenaissance" value="" placeholder="JJ/MM/AAAA">
        </div>      

        <div class="col-sm-6">
          <input type="checkbox" class="checkbox" />Sign up for our newsletter
        </div>

        <div class="col-sm-6">
          <input type="checkbox" class="checkbox" />Send notifications to this email
        </div>        
      
      </div>
    
      <div class="col-md-6">
        <h3 class="dark-grey">Terms and Conditions</h3>
        <p>
          By clicking on "Register" you agree to The Company's' Terms and Conditions
        </p>
        <p>
          Attention en vous inscrivant ici vous attestez que vous êtes médecin - 
          Des documents prouvant ceci vous serons demandé plus tard Ex: Votre diplome. Si vous n'êtes pas médecin vous pourrez être poursuivi pour usurpation d'identité (Paragraph 13.5.8)
        </p>
        <p>
          Si vous commetez des erreurs lors de l'inscription celles ci peuvent être corrigé en envoyant un mail à maachi.reda@gmail.com (Paragraph 13.5.6)
        </p>
        <p>
          Votre compte est activé immédiatement puis est vérifié par la suite. (Paragraph 13.5.6)
        </p>
        
        <button type="submit" name='submit' value='Submit' class="btn btn-primary">Register</button>
      </div>
    </div>
  </section>

</form>





<?php require_once('pagesCommunes/footer.php'); ?>

<script type="text/javascript">

  document.forms["formulaireinscription"].style.display="block";
  var f=document.forms["formulaireinscription"].elements; // On recupere tout les element du formulaire

  function verifMail(){  // On défini une fonction verifMail() qui prend rien parametre
  	var regEmail = new RegExp('^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[.]{1}[a-z]{2,5}$','i'); // Expression réguliere du'une adresse mail
    var mail = f['mail'].value; // On recupere le premier mail
    var mail2 = f['mail2'].value; // Et le mail de vérificatio
  	if (!regEmail.test(f['mail'].value) || !regEmail.test(f['mail2'].value)){ // S'ils correspondent pas à l'expression définie plus haut
  	      document.getElementById("maildejapris").innerHTML = "Rentrez une adresse mail"; // On met un message d'erreur
  	      document.getElementById("maildejapris1").innerHTML = "Rentrez une adresse mail";
  	}
    else if(mail != ''){ // Si les deux mail correspondent à une vraie adresse mail
         $.post('/checkInscription.php',{ mail: mail, mail2: mail2 }, function(data) { // On envoie ces deux mail à /checkInscription.php qui vérifie leur existence dans la base
         $('#maildejapris').text(data); // On rajoute à la div #maildejapris ce que nous retourne la page /checkInscription.php
         $('#maildejapris1').text(data);
         });
    }
  } // Fin de la fonction
</script>