<?php
require_once VIEWS . '\components\header.php';
?>
<main class="container py-3 ">
    <div class="container row">
        <div class="col-10">
            <div class="col-10">
                <h3>Edit Post</h3>
                <h1><?= $header ?? "" ?></h1>
                <form action="posts" method="POST">
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="id" value="<?= $post['post_id'] ?>">

                    <div class="mb-3">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                            value="<?= $_SESSION['old_input']['title'] ?? ($post['title'] ?? '') ?>">
                        <?php if (isset($_SESSION['errors']['title']) && isset($post)): ?>
                            <?php foreach ($_SESSION['errors']['title'] as $error): ?>
                                <div class="text-danger"><?= htmlspecialchars($error) ?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="descr">Description</label>
                        <input type="text" class="form-control" id="descr" name="descr"
                            value="<?= $_SESSION['old_input']['descr'] ?? ($post['descr'] ?? '') ?>">
                        <?php if (isset($_SESSION['errors']['descr']) && isset($post)): ?>
                            <?php foreach ($_SESSION['errors']['descr'] as $error): ?>
                                <div class="text-danger"><?= htmlspecialchars($error) ?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="content">Content</label>
                        <textarea class="form-control" id="content" name="content"
                            rows="15"><?= $_SESSION['old_input']['content'] ?? ($post['content'] ?? '') ?></textarea>
                        <?php if (isset($_SESSION['errors']['content']) && isset($post)): ?>
                            <?php foreach ($_SESSION['errors']['content'] as $error): ?>
                                <div class="text-danger"><?= htmlspecialchars($error) ?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
</main>
<?php
require_once VIEWS . '\components\footer.php';
unset($_SESSION['errors']);
unset($_SESSION['old_input']);
?>