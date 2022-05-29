<!-- ----- début familleViewAll -->
<?php

require($root . '/app/view/fragment/fragmentGenealogieHeader.html');
?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
    include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';
    ?>

    <table class = "table table-striped table-bordered">
        <thead>
        <tr>
            <th scope = "col">Id</th>
            <th scope = "col">Nom</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // La liste des familles est dans une variable $results
        foreach ($results as $element) {
            printf("<tr><td>%d</td><td>%s</td></tr>", $element->getId(),
                $element->getNom());
        }
        ?>
        </tbody>
    </table>
</div>
<?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

<!-- ----- fin familleViewAll -->
