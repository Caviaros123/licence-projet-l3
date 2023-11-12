<!DOCTYPE html>
<html>
<head>
    <title>Projet wmd_23</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <!-- // bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- // jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- // bootstrap js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
</head>
<body>
    <!-- flex nav  -->
<nav class="navbar m-auto w-50 navbar-expand-sm bg-dark navbar-dark">
    <ul class="nav nav-tabs">
        <li><a href="index.php?page=1">Accueil</a></li>
        <li><a href="index.php?page=4">Stat</a></li>
        <li><a href="index.php?page=5">Enquetes</a>
        <li><a href="index.php?page=3">Se Connecter</a></li>
        <li><a href="index.php?page=2">Inscription</a></li>
    </ul>
    <!--  show user cookie data -->
</nav>
<center>
    <div class="flex">

        <h1>Projet wmd_23</h1>
        <!-- position right -->
        <div class="b h4">
            <?php
                if(isset($_COOKIE['user'])){
                    $user = json_decode($_COOKIE['user']);
                    echo "Bienvenue ".$user->prenom." ".$user->nom;
                }
            ?>
        </div>
    </div>
    <?php
	require_once("controleur/user.class.php");
    require_once("controleur/controleur.class.php");

    // Instanciez la classe Controleur
    $unControleur = new Controleur();


    $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
    switch($page){
        case 1: {
            require_once("index.php");
        }break;
        case 2: {

            if(isset($_POST['Valider'])){
                $user = new User();
                $user->renseigner($_POST);
                $userJson = $user->toJson();
                setcookie("user", $userJson, time()+3600);
                var_dump("APPAPAPAPA ====>> ".$user->toJson());
;
                $unControleur->inscription($user->serialiser());
            }
            require_once("vues/vue_inscription.php");
        }break;
        case 3: {
            if(isset($_POST['seConnecter'])){
                $email = $_POST['email'];
                $mdp = $_POST['mdp'];
        
                $user = $unControleur->connexion($email, $mdp);
        
                if($user){
                    $userJson = json_encode($user);
                    setcookie("user",$userJson, time()+3600);
                    header('Location: index.php?page=1');
                }else{
                    // red
                    echo "<div class='alert alert-danger w-25'>Email ou mot de passe incorrect</div>";
                }
            }
            require_once("vues/vue_connexion.php");
        }break;
        case 4: {
            require_once("vues/vue_users.php");
        }break;
        case 5: {
            $unControleur = new Controleur();
            require_once("vues/vue_enquete_1.php");
        }break;

    }
    ?>
</center>
</body>
</html>
