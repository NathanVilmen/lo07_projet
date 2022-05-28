<!-- ----- début evenementViewAdd -->

<?php
require($root . '/app/view/fragment/fragmentGenealogieHeader.html');
require ($root . 'outil/lo07_biblio_formulaire_bt.php');
?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
    include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';

    echo "<h1>Ajout d'un évènement</h1>";

    form_begin('lo07projet', 'GET', 'router.php');
    ?>
    <div class="form-group">
        <input type="hidden" name='action' value='evenementAdded'>
        <label for="individu">Sélectionnez un individu : </label>
        <select class="form-control" id='individu' name='individu' style="width: 300px">
            <?php
            foreach ($individus as $element) {
                if($element->getNom() != "?") { //On ne veut pas afficher les lignes des individus ayant pour nom ? et prénom ?
                    echo "<option>{$element->getNom()} : {$element->getPrenom()}</option>";
                }
            }
            ?>
        </select>
        <?php
        $types_evenement = array('NAISSANCE', 'DECES');
        form_select("Sélectionnez un type d'évènement", 'type', $types_evenement);
        ?>

        <!--<label for="date">Date (AAAA-MM-JJ) ?</label>
        <input type="date" class="form-control" id="date" name="date">-->

        <?php
        form_input_text('Date (AAAA-MM-JJ) ?', 'date', '10');

        form_input_text('Lieu ?', 'lieu', '20');
    echo "</div>";
    form_input_submit("Go");
    form_end();
    ?>
</div>
<?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

<!-- ----- fin evenementViewAdd-->



