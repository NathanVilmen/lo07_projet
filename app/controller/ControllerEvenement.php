
<!-- ----- debut ControllerEvenement -->
<?php
require_once '../model/ModelEvenement.php';
require_once '../model/ModelIndividu.php';
if(!isset($_SESSION)){
    session_start();
}

class ControllerEvenement {
    // --- Liste des évènements
    /**
     * Fonction qui récupère la liste des événements et redirige vers la vue correspondante
     * @return void
     */
    public static function evenementReadAll() {
        if ($_SESSION["famille"]!=NULL && $_SESSION["famille"]!=""){
            $results = ModelEvenement::getAll();
            // ----- Construction chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/evenement/evenementViewAll.php';
            if (DEBUG)
                echo ("ControllerEvenement : evenementReadAll : vue = $vue");
        } else {
            include 'config.php';
            $vue = $root . '/app/view/viewSelectFamilyFirst.php';
        }
        require ($vue);
    }

    //Fonction pour ajouter un événement, est appelée depuis la barre du menu

    /**
     * Fonction qui récupère la liste des individus d'une famille pour construire la vue d'ajout d'un événement.
     * @return void
     */
    public static function evenementAdd(){
        if ($_SESSION["famille"]!=NULL && $_SESSION["famille"]!=""){
            $individus = ModelIndividu::getAllFromFamily($_SESSION["famille"]);

            include 'config.php';

            if($individus==NULL){
                $vue = $root . '/app/view/viewAddItemFirst.php';
            } else{
                $vue = $root . '/app/view/evenement/evenementViewAdd.php';
            }
        } else {
            include 'config.php';
            $vue = $root . '/app/view/viewSelectFamilyFirst.php';
        }

        require ($vue);
    }

    /**
     * Fonction qui récupère les éléments d'insertion d'un événement et construit la vue d'un événement ajouté.
     * @return void
     */
    public static function evenementAdded(){
        $results = ModelEvenement::insert();

        include 'config.php';
        $vue = $root . '/app/view/evenement/evenementViewAdded.php';
        require ($vue);
    }
}
?>
<!-- ----- fin ControllerEvenement -->


