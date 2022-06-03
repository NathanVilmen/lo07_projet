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



}