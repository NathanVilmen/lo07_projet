<!-- ----- début lienViewParentAdded -->

<?php
require($root . '/app/view/fragment/fragmentGenealogieHeader.html');
?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
    include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';

    if($results != NULL){
        echo "<h2>Confirmation de la création d'un lien parental entre {$_GET["enfant"]} et {$_GET["parent"]}</h2>";
    }
    else{
        echo "<h2>Problème dans la création du lien</h2>";
    }
    ?>
</div>
<?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

<!-- ----- fin lienViewParentAdded-->



