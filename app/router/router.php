
<!-- ----- Début Router -->
<?php
    require ('../controller/ControllerFamille.php');
    require ('../controller/ControllerEvenement.php');
    require ('../controller/ControllerLien.php');
    require ('../controller/ControllerIndividu.php');


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

        case "evenementReadAll" :
        case "evenementAdd" :
        case "evenementAdded" :
            ControllerEvenement::$action();
            break;

        case "lienReadAll" :
        case "lienAddParent" :
        case "lienParentAdded" :
        case "lienAddUnion" :
        case "lienUnionAdded" :
            ControllerLien::$action();
            break;

        case "individuReadAll":
            ControllerIndividu::$action();
            break;

        // Tache par défaut
        default:
            $action = "genealogieAccueil";
            ControllerFamille::$action();
    }
?>
<!-- ----- Fin Router -->

