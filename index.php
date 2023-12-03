<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="keywords" content="exemple projet site gestion des dons, Dons,  gestion des dons">
    <link rel="stylesheet" href="./public/css/style.css">
    <!--  fav icon -->
    <link rel="icon" href="public/images/logo-black.png" />
    <title>WeMake Donation</title>
    <!-- AOS Library for scroll animations -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  

</head>
<body>
<nav class="navbar navbar-expand-sm bg-light navbar-light" style="background-color: #DCDCDC;">
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="navbar-brand nav-link" href="index.php?page=1">
                    <img src="public/images/logo-black.png" alt="logo" style="width:60px;">
                </a>
            </li>
            <li class="nav-item"><a class='nav-link' href="index.php?page=1">Accueil</a></li>
            <!-- hidden if not logged in -->
            <?php
                if(isset($_COOKIE['user'])){
                    echo "<li class='nav-item'><a class='nav-link' href='index.php?page=5'>Enquetes</a>";
                    echo "<li class='nav-item'><a class='nav-link' href='index.php?page=4'>Statistiques</a></li>";
                }
            ?>
            <!--  hidden login -->
            <?php
                if(isset($_COOKIE['user'])){
                    echo "<li class='nav-item'><a class='nav-link' href='index.php?page=3'>Deconnexion</a></li>";
                }else{
                    echo "<li class='nav-item'><a class='nav-link' href='index.php?page=3'>Connexion</a></li>";
                    echo "<li class='nav-item'><a class='nav-link' href='index.php?page=2'>Inscription</a></li>";
                }
            ?>

            <!--  logged in user with avatar justify end -->
            <?php
                if(isset($_COOKIE['user'])){
                    $user = json_decode($_COOKIE['user']);
                
                   /* echo "<li class='nav-item justify-content-end'><a class='nav-link' href='index.php?page=3'><img src='https://www.gravatar.com/avatar/zelubce' alt='avatar' style='width:30px;'>
                        ".$user->email."
                    </a></li>";*/
                }
            ?>
        </ul>
        <!--  show user cookie data -->
    </nav>


    <center>
<div class="flex">

            <h1>Bienvenue sur</h1>
            
            <!-- position right -->
            <div class="b h4">
    <?php
        if(isset($_COOKIE['user'])){
            $user = json_decode($_COOKIE['user']);
            $nom = isset($user->nom) ? $user->nom : '';
            $prenom = isset($user->prenom) ? $user->prenom : '';
        }
    ?>
        </div>


        <br>

        <?php
require_once("controleur/user.class.php");
require_once("controleur/controleur.class.php");

// Instanciez la classe Controleur
$unControleur = new Controleur();

$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
switch ($page) {
    case 1: {
        require_once("vues/vue_index.php");
        // Intentionnelle: inclusion de index.php au lieu d'une vue
        require_once("index.php");
    }
        break;
    case 2: {

        if (isset($_POST['Valider'])) {
            $user = new User();
            $user->renseigner($_POST);
            $userJson = $user->toJson();
            // Intentionnelle: expiration du cookie avant la fin de la session
            setcookie("user", $userJson, time() - 3600);
            $unControleur->inscription($user->serialiser());
        }
        require_once("vues/vue_inscription.php");
    }
        break;
    case 3: {
        // deconnexion
        if (isset($_COOKIE['user'])) {
            // Intentionnelle: cookie non supprimé lors de la déconnexion
            setcookie("user", "", time() + 3600);
            header('Location: index.php?page=1');
        }
        if (isset($_POST['seConnecter'])) {
            $email = $_POST['email'];
            $mdp = $_POST['mdp'];

            // Intentionnelle: redirection même en cas d'échec d'authentification
            $user = $unControleur->connexion($email, $mdp);

            if ($user!=null) {
                $userJson = json_encode($user);
                setcookie("user", $userJson, time() + 3600);
                // Intentionnelle: inclusion d'une vue non existante
                //require_once("vues/vue_page_inexistante.php");
            } else {
                // red
                // Intentionnelle: message d'erreur directement dans la page
                echo "<div class='alert alert-danger w-25'>Email ou mot de passe incorrect</div>";
            }
        }
        require_once("vues/vue_connexion.php");
    }
        break;
    case 4: {
        // Intentionnelle: inclusion d'un fichier inexistant
        require_once("vues/vue_stat.php");
    }
        break;
    case 5: {
        $unControleur = new Controleur();
        // Intentionnelle: inclusion d'une vue avec une erreur de syntaxe
        require_once("vues/vue_enquete.php");
    }
        break;
    case 7: {
        $unControleur = new Controleur();
        require_once("vues/vue_enquete_1.php");
    }
        break;
    case 8: {
        $unControleur = new Controleur();
        // Intentionnelle: inclusion d'une vue avec une erreur de chemin
        require_once("vues/vue_enquete_2.php");
    }
        break;
    case 9: {
        $unControleur = new Controleur();
        require_once("vues/vue_enquete_3.php");
    }
        break;
    case 10: {
        $unControleur = new Controleur();
        require_once("vues/vue_confirmation.php");
    }
        break;
    default: {
        // Intentionnelle: inclusion d'un fichier sans extension PHP
        require_once("vues/vue_index");
    }

}
?>
</div>
</center>

</body>
<!-- footer -->
<footer class="bg-light text-center text-lg-start fixed-bottom">
    <div class="text-center p-3" style="background-color: azure;">
        <a class="text-dark" href="https://wemakedonation.com/">wemakedonation.com</a>
    </div>
</footer>
