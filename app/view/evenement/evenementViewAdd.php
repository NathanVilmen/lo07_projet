<!-- ----- début evenementViewAdd -->

<?php
require($root . '/app/view/fragment/fragmentGenealogieHeader.php');
require ($root . 'outil/lo07_biblio_formulaire_bt.php');
?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
    include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';

    form_begin('lo07projet', 'GET', 'evenementAdded');
    ?>
    <label for="individu">Sélectionnez un individu : </label>
    <select class="form-control" id='individu' name='individu' style="width: 300px">
        <?php
        foreach ($individus as $element) {
            echo "<option>{$element->getNom()} : {$element->getPrenom()}";
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
    form_input_submit("Go");
    form_end();
    ?>
</div>
<?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

<!-- ----- fin evenementViewAdd-->



