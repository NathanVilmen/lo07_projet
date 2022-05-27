
<!-- ----- Début Router -->
<?php
require ('../controller/ControllerFamille.php');

// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// fonction parse_str permet de construire 
// une table de hachage (clé + valeur)
parse_str($query_string, $param);

// --- $action contient le nom de la méthode statique recherchée
$action = htmlspecialchars($param["action"]);

//On supprime l'élément action de la structure
unset($param['action']);

//Tout ce qui reste sont des arguments
$args = $param;

// --- Liste des méthodes autorisées
switch ($action) {
    case "familleReadAll":
    case "familleCreate":
    case "familleCreated":
    case "familleReadNom":
    case "familleSelected":
        ControllerFamille::$action();
        break;

    /*case "vinReadAll" :
    case "vinReadOne" :
    case "vinReadId" :
    case "vinCreate" :
    case "vinCreated" :
    case "vinDeleted" :
        ControllerVin::$action($args);
        break;
    case "producteurReadAll" :
    case "producteurReadOne" :
    case "producteurReadId" :
    case "producteurCreate" :
    case "producteurCreated" :
    case "producteurListRegion" :
    case "producteurNombreRegion" :
    case "producteurDeleted" :
        ControllerProducteur::$action($args);
        break;
    case "mesPropositions" :
        ControllerCave::$action();
        break;
    case "recolteReadAll" :
    case "recolteCreate" :
    case "recolteCreated" :
        ControllerRecolte::$action();
        break;*/
    // Tache par défaut
    default:
        $action = "genealogieAccueil";
        ControllerFamille::$action();
}
?>
<!-- ----- Fin Router -->

