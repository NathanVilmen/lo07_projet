
<!-- ----- debut ControllerFamille -->
<?php
require_once '../model/ModelFamille.php';
if(!isset($_SESSION)){
    session_start();
}

class ControllerFamille {
    // --- page d'accueil
    /**
     * Fonction qui renvoie vers la vue d'accueil.
     * @return void
     */
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

    /**
     * Fonction qui récupère les individus d'une famille pour construire la vue générale de la famille.
     * @return void
     */
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

    /**
     * Fonction qui renvoie vers la vue de création d'une famille.
     * @return void
     */
    public static function familleCreate() {
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/famille/familleViewInsert.php';
        require ($vue);
    }

    /**
     * Fonction qui récupère les informations de la famille créée et renvoie vers la vue d'une famille créée.
     * @return void
     */
    public static function familleCreated() {
        // ajouter une validation des informations du formulaire
        $results = ModelFamille::insert(htmlspecialchars($_GET['nom']));

        //affectation de la variable de session
        $_SESSION["famille"]=$_GET['nom'];

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/famille/familleViewInserted.php';
        require ($vue);
    }


    // Affiche un formulaire pour sélectionner un id qui existe

    /**
     * Fonction qui récupère tous les noms d'une famille et renvoie vers la vue correspondante.
     * @return void
     */
    public static function familleReadNom() {
        $results = ModelFamille::getAllName();

        if (DEBUG)
            echo ("ControllerFamille : familleReadNom</br>");
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/famille/familleViewNom.php';
        require ($vue);
    }


    /**
     * Fonction qui récupère l'id de la famille sélectionnée et renvoie la vue correspondante.
     * @return void
     */
    public static function familleSelected(){

        //Initialise la variable de session sur la valeur transmise par le formulaire
        $_SESSION["famille"]=$_GET['nom'];
        $nom = $_GET['nom'];

        //Cherche l'id de la famille qui correspopnd au nom
        $id=ModelFamille::getIdFamily($nom);
        include 'config.php';
        $vue = $root . '/app/view/famille/familleViewNomSelected.php';
        require ($vue);
    }


}
?>
<!-- ----- fin ControllerFamille --- -->


