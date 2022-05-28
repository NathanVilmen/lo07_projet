
<!-- ----- début viewNomSelected -->
<?php
require($root . '/app/view/fragment/fragmentGenealogieHeader.html');
?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
    include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';

    // $results contient un tableau avec la liste des clés.
    ?>
    <h2>Confirmation de la sélection d'une famille</h2>
    <?php printf("<p>La famille %s (%d) est maintenant sélectionnée</p>", $nom, 1002) ?>
</div>

<?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

<!-- ----- fin viewNomSelected -->