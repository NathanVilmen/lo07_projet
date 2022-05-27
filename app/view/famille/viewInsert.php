
<!-- ----- début viewInsert -->

<?php
require($root . '/app/view/fragment/fragmentGenealogieHeader.php');
?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
    include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';
    ?>

    <form role="form" method='get' action='router.php'>
        <div class="form-group">
            <h2>Création d'une famille</h2>
            <input type="hidden" name='action' value='familleCreated'>
            <label for="id">nom : </label><input type="text" name='nom' size='75' value='Mirgalet'>
        </div>
        <p/>
        <button class="btn btn-primary" type="submit">Créer la famille</button>
    </form>
    <p/>
</div>
<?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

<!-- ----- fin viewInsert -->



