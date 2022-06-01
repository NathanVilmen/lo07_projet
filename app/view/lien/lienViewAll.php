<!-- ----- début lienViewAll -->
<?php

require($root . '/app/view/fragment/fragmentGenealogieHeader.html');
?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
    include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';
    ?>

    <h2>Liste des liens :</h2>
    <table class = "table table-striped table-bordered">
        <thead>
        <tr>
            <th scope = "col">famille_id</th>
            <th scope = "col">id</th>
            <th scope = "col">iid1</th>
            <th scope = "col">iid2</th>
            <th scope = "col">lien_type</th>
            <th scope = "col">lien_date</th>
            <th scope = "col">lien_lieu</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // La liste des familles est dans une variable $results
        foreach ($results as $element) {
            printf("<tr><td>%d</td><td>%d</td><td>%d</td><td>%d</td><td>%s</td><td>%s</td><td>%s</td></tr>", $element->getFamilleId(),
                $element->getId(), $element->getIid1(), $element->getIid2(), $element->getLienType(), $element->getLienDate(), $element->getLienLieu());
        }
        ?>
        </tbody>
    </table>
</div>
<?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

<!-- ----- fin lienViewAll -->
