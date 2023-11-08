<!DOCTYPE html>
<html>
<head>
    <title>Projet wmd_23</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
</head>
<body>
<nav>
<ul>
    <li><a href="index.php?page=1">Accueil</a></li>
    
    <li><a href="index.php?page=2">Inscription</a></li>
    <li><a href="index.php?page=3">Se Connecter</a></li>
    <li><a href="index.php?page=4">Stat</a></li>
    <li><a href="index.php?page=5">Enquetes</a>
</ul>

</nav>
<center>
    <h1>Projet wmd_23</h1>
    <?php
	require_once("controleur/user.class.php"); 
    require_once("controleur/controleur.class.php");

    // Instanciez la classe Controleur
    $unControleur = new Controleur();

    if(isset($_POST['Valider'])){
        $user = new User();
        $user->renseigner($_POST);
        $userJson = $user->toJson();
        setcookie("user",$userJson, time()+3600);
        $unControleur->inscription($user->serialiser());
    }

    $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
    switch($page){
        case 1: {
            require_once("index.php");
        }break;
        case 2: {
            require_once("vues/vue_ins.php");
        }break;
        case 3: {
            require_once("vues/vue_form.php");
        }break;
        case 4: {
            require_once("vues/vue_users.php");
        }break;
        case 5: {
            require_once("vues/vue_enquete_1.php");
        }break;

    }
    ?>
</center>
</body>
</html>
