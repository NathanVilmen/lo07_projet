<!-- ----- début individuViewSelect -->

<?php
require($root . '/app/view/fragment/fragmentGenealogieHeader.html');
require ($root . 'outil/lo07_biblio_formulaire_bt.php');
?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
    include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';

    echo "<h1>Sélection d'un individu</h1>";

    form_begin('lo07projet', 'GET', 'router.php');
    ?>
    <div class="form-group">
        <input type="hidden" name='action' value='individuSelected'>
        <label for="enfant">Sélectionnez un individu : </label>
        <select class="form-control" id='enfant' name='individu' style="width: 300px">
            <?php
            foreach ($individus as $element) {
                if($element->getNom() != "?") { //On ne veut pas afficher les lignes des individus ayant pour nom ? et prénom ?
                    echo "<option>{$element->getNom()} : {$element->getPrenom()}</option>";
                }
            }
            ?>
        </select>
    </div>
    <?php
    form_input_submit("Sélectionner");
    form_end();
    ?>
</div>
<?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

<!-- ----- fin individuViewSelect-->



