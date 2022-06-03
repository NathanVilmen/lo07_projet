
<!-- ----- début individuViewInsert -->

<?php
require($root . '/app/view/fragment/fragmentGenealogieHeader.html');
?>

<body>
<div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
    include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';
    ?>

    <form role="form" method='get' action='router.php'>
        <div class="form-group">
            <h2>Création d'un individu</h2>
            <input type="hidden" name='action' value='individuCreated'>
            <label for="id">Nom : </label><br/><input type="text" name='nom' size='75' value='HALLIDAY'><br/>
            <label for="id">Prénom : </label><br/><input type="text" name='prenom' size='75' value='Marc'><br/>

            <label for="id">Sexe : </label><br/>
                <input type="radio" id="sexeChoice1" name="sexe" value="masculin" checked>
                <label for="sexeChoice1">Masculin</label>
                <input type="radio" id="sexeChoice2" name="sexe" value="feminin">
                <label for="sexeChoice2">Féminin</label>

        </div>
        <p/>
        <button class="btn btn-primary" type="submit">Créer l'individu</button>
    </form>
    <p/>
</div>
<?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

<!-- ----- fin individuViewInsert -->



