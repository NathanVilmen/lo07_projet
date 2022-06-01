<!-- ----- début lienViewUnionAdded -->

<?php
require($root . '/app/view/fragment/fragmentGenealogieHeader.html');
?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
    include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';

    if($results != NULL){
        echo "<h2>Confirmation de la création d'un lien Union :</h2>";
        echo "<ul><li>famille_id = $results[0]</li>";
        echo "<li>homme_id = $results[1]</li>";
        echo "<li>femme_id = $results[2]</li>";
        echo "<li>lien_type = " . $_GET["type"] . "</li>";
        echo "<li>lien_date = {$_GET["date"]}</li>";
        echo "<li>lien_lieu = {$_GET["lieu"]}</li></ul>";
    }
    else{
        echo "<h2>Problème dans la création d'un lien Union</h2>";
    }
    ?>
</div>
<?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

<!-- ----- fin lienViewUnionAdded-->



