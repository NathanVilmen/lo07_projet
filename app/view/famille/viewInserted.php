
<!-- ----- début viewInserted -->
<?php
require($root . '/app/view/fragment/fragmentGenealogieHeader.php');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
    include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';
    ?>
    <!-- ===================================================== -->
    <?php
    if ($results) {
     echo ("<h3>Confirmation de la création d'une famille</h3>");
     echo("<ul>");
     echo ("<li>nom = " . $_GET['nom']. "</li>");
     echo("</ul>");
    } else {
     echo ("<h3>Problème d'insertion de la famille</h3>");
     echo ("id = NULL");
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentGenealogieFooter.html';
    ?>
    <!-- ----- fin viewInserted -->    

    
    