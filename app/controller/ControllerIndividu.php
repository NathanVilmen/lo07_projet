<!-- ----- debut ControllerIndividu -->


<?php
require_once '../model/ModelIndividu.php';
session_start();

class ControllerIndividu
{
    // --- Liste des individus
    public static function individuReadAll() {
        $results = ModelIndividu::getAllFromFamily($_SESSION["famille"]);
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/individu/individuViewAll.php';
        if (DEBUG)
            echo ("ControllerIndividu : individuReadAll : vue = $vue");
        require ($vue);
    }


    public static function individuCreate() {
        include 'config.php';
        if ($_SESSION["famille"]!=NULL && $_SESSION["famille"]!=""){
            $vue = $root . '/app/view/individu/individuViewInsert.php';
        } else {
            $vue = $root . '/app/view/individu/individuSelectFamilyFirst.php';
        }
        require ($vue);
    }


    public static function individuCreated() {
        // ajouter une validation des informations du formulaire
        $famille=$_SESSION["famille"];
        $results = ModelIndividu::insert($famille, htmlspecialchars($_GET['nom']), htmlspecialchars($_GET['prenom']), htmlspecialchars($_GET['sexe']));

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/individu/individuViewInserted.php';
        require ($vue);
    }

}