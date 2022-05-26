
<!-- ----- debut ControllerFamille -->
<?php
//require_once '../model/ModelFamille.php';

class ControllerFamille {
    // --- page d'accueil
    public static function genealogieAccueil() {
     include 'config.php';
     $vue = $root . '/app/view/viewGenealogieAccueil.php';
     if (DEBUG)
      echo ("ControllerGenealogie : genealogieAccueil : vue = $vue");
     require ($vue);
    }
}
?>
<!-- ----- fin ControllerFamille -->


