
<!-- ----- début individuViewInserted -->
<?php
require($root . '/app/view/fragment/fragmentGenealogieHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
    include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';
    ?>
    <!-- ===================================================== -->
    <?php
    if ($results != NULL) {
        echo ("<h3>Confirmation de la création d'un individu</h3>");
        echo("<ul>");
        echo ("<li>famille_id = " . $results[0]. "</li>");
        echo ("<li>id = " . $results[1]. "</li>");
        echo ("<li>nom = " . $results[2]. "</li>");
        echo ("<li>prenom = " . $results[3]. "</li>");
        echo ("<li>sexe = " . $results[4]. "</li>");
        // Comme l'individu vient d'être créé, ses parents ne sont pas encore définis, ils sont donc initialisés à 0.
        echo ("<li>pere = 0</li>");
        echo ("<li>mere = 0</li>");
        echo("</ul>");
    } else {
     echo ("<h3>Problème d'insertion de l'individu</h3>");
     echo ("id = NULL");
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentGenealogieFooter.html';
    ?>
    <!-- ----- fin familleViewInserted -->

    
    