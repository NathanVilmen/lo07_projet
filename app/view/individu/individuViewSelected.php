<!-- ----- début individuViewSelected -->

<?php
require($root . '/app/view/fragment/fragmentGenealogieHeader.html');
?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
    include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';

    if($results != NULL){
        echo "<div class='individu'><h1>".$results[0]." ".$results[1]."</h1></div>";
        echo "<ul><li>Né le ". $results[2]." à ".$results[3]."</li>";
        echo "<li>Décès le ".$results[4]." à ".$results[5]."</li></ul><br/>";

        echo "<h1>Parents</h1>";
        echo "<ul><li>Père : </li>";
        echo "<li>Mère : </li></ul>";

    }
    else{
        echo "<h2>Problème dans la sélection de l'individu</h2>";
    }
    ?>
</div>
<?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

<!-- ----- fin individuViewSelected-->



