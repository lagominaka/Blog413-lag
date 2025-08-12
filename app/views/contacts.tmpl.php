<?php
require_once VIEWS . '\components\header.php';
?>
<main class="container py-3">
   <div class="container row">

      <div class="col-10">

         <h3><?= $header ?? "" ?></h3>

      </div>

      <? require_once VIEWS . '\components\sidebar.php'; ?>

   </div>
   </div>
</main>
<?
require_once VIEWS . '\components\footer.php';
?>