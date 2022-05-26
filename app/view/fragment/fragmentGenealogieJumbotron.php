<!-- ----- debut fragmentCaveJumbotron -->
<?php session_start()?>

<div class="jumbotron">
  <?php
  if(isset($_SESSION["famille"])) {
      echo "<h1>FAMILLE {$_SESSION["famille"]}</h1>";
  }
  else{
      echo "<h1>PAS DE FAMILLE SELECTIONNEE</h1>";
  }
  ?>
</div>
<!-- ----- fin fragmentCaveJumbotron -->