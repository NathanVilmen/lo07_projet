
<!-- ----- debut ControllerFamille -->
<?php
require_once '../model/ModelFamille.php';
if(!isset($_SESSION)){
    session_start();
}

class ControllerFamille {
    // --- page d'accueil
    public static function genealogieAccueil() {
        include 'config.php';
        $vue = $root . '/app/view/viewGenealogieAccueil.php';

        //Suppression de la variable de session; on considère qu'en revenant à l'accueil on désélectionne la famille
        $_SESSION["famille"]=NULL;
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
        $vue = $root . '/app/view/famille/familleViewInserted.php';
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

        //Initialise la variable de session sur la valeur transmise par le formulaire
        $_SESSION["famille"]=$_GET['nom'];
        $nom = $_GET['nom'];

        //Cherche l'id de la famille qui correspopnd au nom
        $id=ModelFamille::getIdFamille($nom);
        include 'config.php';
        $vue = $root . '/app/view/famille/familleViewNomSelected.php';
        require ($vue);
    }


}
?>
<!-- ----- fin ControllerFamille --- -->


