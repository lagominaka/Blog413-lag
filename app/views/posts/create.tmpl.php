<?php
require_once VIEWS . '\components\header.php';
?>
<main class="container py-3">
  <div class="row">
    <h3>New post</h3>
    <div class="col-10">     
      <form action="posts" method="POST">
        <!-- заголовок -->
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Post title" value="<?= old(field_name: 'title') ?>">
          <?= isset($validator) ? $validator->listErrors('title') : "" ?>
        </div>
        <!-- описание -->
        <div class="mb-3">
          <label for="descr" class="form-label">Description</label>
          <input type="text" class="form-control" id="descr" name="descr" placeholder="Post description" value="<?= old(field_name: 'descr') ?>">
          <?= isset($validator) ? $validator->listErrors('descr') : "" ?>
        </div>

        <div class="mb-3">
          <label for="content" class="form-label">Content</label>
          <textarea type="text" class="form-control" id="content" name="content" rows="15" placeholder="Post content"><?= old(field_name: 'content') ?></textarea>
          <?= isset($validator) ? $validator->listErrors('content') : "" ?>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
      </form>
    </div>
  </div>
</main>
<?
require_once VIEWS . '\components\footer.php';
?>