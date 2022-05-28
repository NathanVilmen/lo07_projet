<!-- ----- début lienViewAddUnion -->

<?php
require($root . '/app/view/fragment/fragmentGenealogieHeader.html');
require ($root . 'outil/lo07_biblio_formulaire_bt.php');
?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
    include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';

    echo "<h1>Ajout d'une union</h1>";

    form_begin('lo07projet', 'GET', 'router.php');
    ?>
    <div class="form-group">
        <input type="hidden" name='action' value='lienUnionAdded'>
        <label for="homme">Sélectionnez un homme : </label>
        <select class="form-control" id='homme' name='homme' style="width: 300px">
            <?php
            foreach ($individus as $element) {
                if($element->getNom() != "?" && $element->getSexe() == "H") { //On ne veut pas afficher les lignes des individus ayant pour nom ? et prénom ? ET qui sont des femmes
                    echo "<option>{$element->getNom()} : {$element->getPrenom()}</option>";
                }
            }
            ?>
        </select>
        <label for="femme">Sélectionnez une femme : </label>
        <select class="form-control" id='femme' name='femme' style="width: 300px">
            <?php
            foreach ($individus as $element) {
                if($element->getNom() != "?" && $element->getSexe() == "F") { //On ne veut pas afficher les lignes des individus ayant pour nom ? et prénom ? ET qui sont des hommes
                    echo "<option>{$element->getNom()} : {$element->getPrenom()}";
                }
            }
            ?>
        </select>

        <?php
        $types_union = array('COUPLE', 'SEPARATION', 'PACS', 'MARIAGE', 'DIVORCE');
        form_select("Sélectionnez un type d'unio", 'type', $types_union);

        form_input_text('Date (AAAA-MM-JJ) ?', 'date', '10');

        form_input_text('Lieu ?', 'lieu', '20');

    echo "</div>";

    form_input_submit("Go");
    form_end();
    ?>
</div>
<?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

<!-- ----- fin lienViewAddUnion-->



