<!-- ----- début lienViewAddParent -->

<?php
require($root . '/app/view/fragment/fragmentGenealogieHeader.html');
require ($root . 'outil/lo07_biblio_formulaire_bt.php');
?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
    include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';

    echo "<h1>Ajout d'un lien parental</h1>";

    form_begin('lo07projet', 'GET', 'router.php');
    ?>
    <div class="form-group">
        <input type="hidden" name='action' value='lienParentAdded'>
        <label for="enfant">Sélectionnez un enfant : </label>
        <select class="form-control" id='enfant' name='enfant' style="width: 300px">
            <?php
            foreach ($individus as $element) {
                if($element->getNom() != "?") { //On ne veut pas afficher les lignes des individus ayant pour nom ? et prénom ?
                    echo "<option>{$element->getNom()} : {$element->getPrenom()}";
                }
            }
            ?>
        </select>
        <label for="parent">Sélectionnez un parent : </label>
        <select class="form-control" id='parent' name='parent' style="width: 300px">
            <?php
            foreach ($individus as $element) {
                if($element->getNom() != "?") { //On ne veut pas afficher les lignes des individus ayant pour nom ? et prénom ?
                    echo "<option>{$element->getNom()} : {$element->getPrenom()}";
                }
            }
            ?>
        </select>
    </div>
    <?php
    form_input_submit("Go");
    form_end();
    ?>
</div>
<?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

<!-- ----- fin lienViewAddParent-->



