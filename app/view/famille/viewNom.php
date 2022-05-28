
<!-- ----- début viewNom -->
<?php
require($root . '/app/view/fragment/fragmentGenealogieHeader.html');
?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
    include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';

    // $results contient un tableau avec la liste des clés.
    ?>

    <form role="form" method='get' action='router.php'>
        <div class="form-group">
            <input type="hidden" name='action' value='familleSelected'>
            <label for="id">Nom : </label> <select class="form-control" id='id' name='nom' style="width: 100px">
                <?php
                foreach ($results as $nom) {
                    echo ("<option>$nom</option>");
                }
                ?>
            </select>
        </div>
        <p/>
        <button class="btn btn-primary" type="submit">Sélectionner</button>
    </form>
    <p/>
</div>

<?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

<!-- ----- fin viewNom -->