<?php

require_once VIEWS . '\components\header.php';
?>
<main class="container py-3">
    <div class="container row">
        <div class="col-10">

            <form action="posts/update" method="POST">
                <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post['post_id']); ?>">

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Post title" value="<?= htmlspecialchars($post['title']) ?>">

                </div>
                <!-- описание -->
                <div class="mb-3">
                    <label for="descr" class="form-label">Description</label>
                    <input type="text" class="form-control" id="descr" name="descr" placeholder="Post description" value="<?= htmlspecialchars($post['descr']) ?>">
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea type="text" class="form-control" id="content" name="content" rows="15" placeholder="Post content"><?= htmlspecialchars($post['content']) ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</main>
<?php
require_once VIEWS . '\components\footer.php';
?>