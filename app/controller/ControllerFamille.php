
<!-- ----- debut ControllerFamille -->
<?php
require_once '../model/ModelFamille.php';
session_start();

class ControllerFamille {
    // --- page d'accueil
    public static function genealogieAccueil() {
     include 'config.php';
     $vue = $root . '/app/view/viewGenealogieAccueil.php';
     if (DEBUG)
      echo ("ControllerGenealogie : genealogieAccueil : vue = $vue");
     require ($vue);
    }


    // --- Liste des familles
    public static function familleReadAll() {
        $results = ModelFamille::getAll();
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/famille/familleViewAll.php';
        if (DEBUG)
            echo ("ControllerFamille : familleReadAll : vue = $vue");
        require ($vue);
    }



    // Affiche le formulaire de creation d'une famille
    public static function familleCreate() {
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/famille/familleViewInsert.php';
        require ($vue);
    }

    public static function familleCreated() {
        // ajouter une validation des informations du formulaire
        $results = ModelFamille::insert(htmlspecialchars($_GET['nom']));

        //affectation de la variable de session
        //session_start();
        $_SESSION["famille"]=$_GET['nom'];

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/famille/FamilleViewInserted.php';
        require ($vue);
    }


    // Affiche un formulaire pour sélectionner un id qui existe
    public static function familleReadNom() {
        $results = ModelFamille::getAllNom();

        if (DEBUG)
            echo ("ControllerFamille : familleReadNom</br>");
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/famille/familleViewNom.php';
        require ($vue);
    }


    public static function familleSelected(){
        //session_start();
        $_SESSION["famille"]=$_GET['nom'];
        $nom = $_GET['nom'];
        include 'config.php';
        $vue = $root . '/app/view/famille/familleViewNomSelected.php';
        require ($vue);
    }


}
?>
<!-- ----- fin ControllerFamille --- -->


