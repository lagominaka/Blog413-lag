<?php
require_once VIEWS . '\components\header.php';
?>
<main class="container py-3">
   <div class="row">

      <div class="col-10">

         <h3><?= $header ?? "" ?></h3>
         <div><?= $post['content'] ?></div>

         <div class="row col-3">
            <form class="col" action="posts/edit" method="GET">
               <input type="hidden" name="id" value="<?= $post['post_id'] ?>">
               <button type="submit" class="btn btn-primary px-4 mt-3">Edit</button>
            </form>
            <form class="col" action="posts" method="POST">
               <input type="hidden" name="_method" value="delete">
               <input type="hidden" name="id" value="<?= $post['post_id'] ?>">
               <button type="submit" class="btn btn-danger mt-3">Delete</button>
            </form>
         </div>



      </div>

      <? require_once VIEWS . '\components\sidebar.php'; ?>
   </div>
</main>
<?
require_once VIEWS . '\components\footer.php';
?>