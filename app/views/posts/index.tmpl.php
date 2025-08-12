<?php
require_once VIEWS . '\components\header.php';
?>
<main class="container py-3">
    <div class="row">

        <div class="col-10">

            <h3><?= $header ?? "" ?></h3>

            <? foreach ($posts as $post) : ?>
                <div class="card mb-3 col-11">
                    <div class="card-body">
                        <h5 class="card-title"><a href="posts?id=<?= $post['post_id'] ?>"><?= $post['title'] ?></a></h5>
                        <p class="card-text"><?= $post['descr'] ?></p>
                        <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            <? endforeach; ?>

        </div>

        <? require_once VIEWS . '\components\sidebar.php'; ?>
    </div>
</main>
<?
require_once VIEWS . '\components\footer.php';
?>