<!-- ----- début evenementViewAdded -->

<?php
require($root . '/app/view/fragment/fragmentGenealogieHeader.html');
?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
    include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';

    if($results != NULL){
        echo "<h2>Confirmation de la création d'un événement</h2>";
        echo "<ul><li>famille_id = $results[0]</li>";
        echo "<li>individu_id = $results[1]</li>";
        echo "<li>event_id = $results[2]</li>";
        echo "<li>event_type = " . $_GET["type"] . "</li>";
        echo "<li>event_date = {$_GET["date"]}</li>";
        echo "<li>event_lieu = {$_GET["lieu"]}</li></ul>";
    }
    else{
        echo "<h2>Problème dans la création de l'évenement</h2>";
    }
    ?>
</div>
<?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

<!-- ----- fin evenementViewAdded-->



