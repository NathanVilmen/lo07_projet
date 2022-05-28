
<!-- ----- debut ControllerEvenement -->
<?php
require_once '../model/ModelLien.php';
require_once '../model/ModelIndividu.php';
session_start();

class ControllerLien {
    // --- Liste des évènements
    public static function lienReadAll() {
        $results = ModelLien::getAll();
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/lien/lienViewAll.php';
        if (DEBUG)
            echo ("ControllerLien : lienReadAll : vue = $vue");
        require ($vue);
    }

    //Fonction pour ajouter un lien parental
    public static function lienAddParent(){
        $individus = ModelIndividu::getAllFromFamily($_SESSION["famille"]);

        include 'config.php';
        $vue = $root . '/app/view/lien/lienViewAddParent.php';
        require ($vue);
    }

    public static function lienParentAdded(){
        $results = ModelLien::update();

        include 'config.php';
        $vue = $root . '/app/view/lien/lienViewParentAdded.php';
        require ($vue);
    }
}
?>
<!-- ----- fin ControllerEvenement -->


