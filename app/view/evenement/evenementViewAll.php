<!-- ----- début evenementViewAll -->
<?php

require($root . '/app/view/fragment/fragmentGenealogieHeader.php');
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
            <th scope = "col">famille_id</th>
            <th scope = "col">id</th>
            <th scope = "col">iid</th>
            <th scope = "col">event_type</th>
            <th scope = "col">event_date</th>
            <th scope = "col">event_lieu</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // La liste des familles est dans une variable $results
        foreach ($results as $element) {
            printf("<tr><td>%d</td><td>%d</td><td>%d</td><td>%s</td><td>%s</td><td>%s</td></tr>", $element->getFamilleId(),
                $element->getId(), $element->getIid(), $element->getEventType(), $element->getEventDate(), $element->getEventLieu());
        }
        ?>
        </tbody>
    </table>
</div>
<?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

<!-- ----- fin evenementViewAll -->
