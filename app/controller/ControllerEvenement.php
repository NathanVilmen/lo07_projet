
<!-- ----- debut ControllerEvenement -->
<?php
require_once '../model/ModelEvenement.php';
require_once '../model/ModelIndividu.php';
session_start();

class ControllerEvenement {
    // --- Liste des évènements
    public static function evenementReadAll() {
        $results = ModelEvenement::getAll();
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/evenement/evenementViewAll.php';
        if (DEBUG)
            echo ("ControllerEvenement : evenementReadAll : vue = $vue");
        require ($vue);
    }

    //Fonction pour ajouter un événement, est appelée depuis la barre du menu
    public static function evenementAdd(){
        $individus = ModelIndividu::getAllFromFamily($_SESSION["famille"]);

        include 'config.php';
        $vue = $root . '/app/view/evenement/evenementViewAdd.php';
        require ($vue);
    }

    public static function evenementAdded(){
        $results = ModelEvenement::insert();

        include 'config.php';
        $vue = $root . '/app/view/evenement/evenementViewAdded.php';
        require ($vue);
    }
}
?>
<!-- ----- fin ControllerEvenement -->


