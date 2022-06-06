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
        echo "<ul><li>Père : <a href='router.php?action=individuSelected&individu='.$results[6].$results[7]>".$results[6]." ".$results[7]."</a></li>";
        echo "<li>Mère : <a href='router.php?action=individuSelected&target='>".$results[8]." ".$results[9]."</a></li></ul>";

        echo "<h1>Unions et enfants</h1>";
        $i=0;
        foreach ($results[10] as $nom_mariee){
            echo "<ul><li>Union avec <a href='router.php?action=individuSelected&individu='.$nom_mariee.$results[11][$i].></a></li>";
            echo "<ol>";
            foreach ($results[12][$i] as $enfant){

                echo "<li>Enfant ".$enfant[0]." ".$enfant[1]."</li>";
            }
            echo "</ol>";
            echo "</ul>";
            $i++;
        }
    }
    else{
        echo "<h2>Problème dans la sélection de l'individu</h2>";
    }
    ?>
</div>
<?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

<!-- ----- fin individuViewSelected-->



