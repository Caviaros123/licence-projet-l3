<h3> Inscription Utilisateur </h3>
<form method="post" id="inscription-form">
    Nom : <br>
    <input type="text" name="nom" id="nom" onblur="c_nom()"> <br>
    Prénom : <br>
    <input type="text" name="prenom" id="prenom" onblur="c_prenom()"> <br>
    Age : <br>
    <input type="number" id="age" name="age" onblur="c_age()"> <br>
    Email : <br>
    <input type="text" name="email" id="email" onblur="c_email()"> <br>
    Telephone : <br>
    <input type="text" name="telephone" id="telephone" onblur="c_telephone()"> <br>
    Mot de passe: <br>
    <input type="password" name="mdp" id="mdp"> <br>

    <!-- Affichage du message d'erreur -->
    <div id="erreurEmail" style="color: red; display: none;"></div>
    <div id="erreurPrenom" style="color: red; display: none;"></div>
    <div id="erreurNom" style="color: red; display: none;"></div>
    <div id="erreurAge" style="color: red; display: none;"></div>
    <div id="erreurTelephone" style="color: red; display: none;"></div>

    <button name="Valider"> Valider </button>
</form>

<script type="text/javascript">

function c_nom() {
    var nomField = document.getElementById('nom');
    var nom = nomField.value;
    var nomRegex = /^[a-zA-Z' ]{1,20}$/;

    if (nom.match(nomRegex) && nom.length >= 3) {
        nomField.style.backgroundColor = "green";
        document.getElementById('erreurNom').style.display = 'none';
    } else {
        nomField.style.backgroundColor = "red";
        // Afficher le message d'erreur
        if (nom.length < 3) {
            document.getElementById('erreurNom').innerHTML = 'Le nom doit contenir au moins 3 caractères.';
        } else {
            document.getElementById('erreurNom').innerHTML = 'Le champ nom est invalide. Veuillez fournir un nom valide.';
        }
        document.getElementById('erreurNom').style.color = 'red';
        document.getElementById('erreurNom').style.display = 'block';
    }
}


function c_prenom() {
    var prenomField = document.getElementById('prenom');
    var prenom = prenomField.value;
    var prenomRegex = /^[a-zA-Z' ]{1,20}$/;

    if (prenom.match(prenomRegex) && prenom.length >= 3) {
        prenomField.style.backgroundColor = "green";
        document.getElementById('erreurPrenom').style.display = 'none';
    } else {
        prenomField.style.backgroundColor = "red";

        // Afficher le message d'erreur si  
        if (prenom.length < 3) {
            document.getElementById('erreurPrenom').innerHTML = 'Le prénom doit contenir au moins 3 caractères.';
        } else {
            document.getElementById('erreurPrenom').innerHTML = 'Le champ prénom est invalide. Veuillez fournir un prénom valide.';
        }
        document.getElementById('erreurPrenom').style.color = 'red';
        document.getElementById('erreurPrenom').style.display = 'block';
    }
}

function c_age(){
		var age = document.getElementById('age').value;
		if(age >= 18 && age <= 99){
			document.getElementById('age').style.backgroundColor="green";
		}else{
			document.getElementById('age').style.backgroundColor="red";
		}
	}


function c_email() {
    var emailField = document.getElementById('email');
    var email = emailField.value;
    var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (email.match(emailRegex)) {
        emailField.style.backgroundColor = "green";
        document.getElementById('erreurEmail').style.display = 'none';
    } else {
        emailField.style.backgroundColor = "red";
        // Afficher le message d'erreur
        document.getElementById('erreurEmail').innerHTML = 'Le champ nom est invalide. Veuillez fournir un nom valide.';
        document.getElementById('erreurEmail').style.color = 'red';
        document.getElementById('erreurEmail').style.display = 'block';
    }
}

function c_telephone() {
    var telephoneField = document.getElementById('telephone');
    var telephone = telephoneField.value;
    var telephoneRegex = /^\d{10}$/;

    if (telephone.match(telephoneRegex)) {
        telephoneField.style.backgroundColor = "green";
        document.getElementById('erreurtelephone').style.display = 'none';
    } else {
        telephoneField.style.backgroundColor = "red";

        // Afficher le message d'erreur
        if (telephone.length === 10) {
            document.getElementById('erreurtelephone').innerHTML = 'Le numéro de téléphone est invalide. Veuillez fournir un numéro de téléphone valide de 10 chiffres.';
        } else {
            document.getElementById('erreurtelephone').innerHTML = 'Le numéro de téléphone doit contenir exactement 10 chiffres.';
        }
        document.getElementById('erreurtelephone').style.color = 'red';
        document.getElementById('erreurtelephone').style.display = 'block';
    }
}

</script>
