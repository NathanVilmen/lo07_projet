
<!-- ----- debut ControllerEvenement -->
<?php
require_once '../model/ModelLien.php';
require_once '../model/ModelIndividu.php';
if(!isset($_SESSION)){
    session_start();
}

class ControllerLien {
    // --- Liste des évènements
    public static function lienReadAll() {
        if ($_SESSION["famille"]!=NULL && $_SESSION["famille"]!=""){
            $results = ModelLien::getAll();
            // ----- Construction chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/lien/lienViewAll.php';
            if (DEBUG)
                echo ("ControllerLien : lienReadAll : vue = $vue");
        } else {
            include 'config.php';
            $vue = $root . '/app/view/viewSelectFamilyFirst.php';
        }

        require ($vue);
    }

    //Fonction pour ajouter un lien parental
    public static function lienAddParent(){
        if ($_SESSION["famille"]!=NULL && $_SESSION["famille"]!=""){
            $individus = ModelIndividu::getAllFromFamily($_SESSION["famille"]);

            include 'config.php';
            $vue = $root . '/app/view/lien/lienViewAddParent.php';
        } else {
            include 'config.php';
            $vue = $root . '/app/view/viewSelectFamilyFirst.php';
        }

        require ($vue);
    }

    public static function lienParentAdded(){
        $results = ModelLien::update();

        include 'config.php';
        $vue = $root . '/app/view/lien/lienViewParentAdded.php';
        require ($vue);
    }

    public static function lienAddUnion(){
        if ($_SESSION["famille"]!=NULL && $_SESSION["famille"]!=""){
            $individus = ModelIndividu::getAllFromFamily($_SESSION["famille"]);

            include 'config.php';
            $vue = $root . '/app/view/lien/lienViewAddUnion.php';
        } else {
            include 'config.php';
            $vue = $root . '/app/view/viewSelectFamilyFirst.php';
        }

        require ($vue);
    }

    public static function lienUnionAdded(){
        $results = ModelLien::insert();

        include 'config.php';
        $vue = $root . '/app/view/lien/lienViewUnionAdded.php';
        require ($vue);
    }
}
?>
<!-- ----- fin ControllerEvenement -->


