<?php
require_once VIEWS . '\components\header.php';
?>

<main class="container py-3">
    <div class="row">
        <div class="col-10">
            <form action="/users/reset-password" method="POST" class="container col-lg-6 col-md-12 col-sm-12">

                <h3 class="mt-3 mb-3">Changing the password</h3>

                <div class="mb-3">
                    <label for="login" class="form-label">Login</label>
                    <input type="text" class="form-control" id="login" name="login"
                        value="<?= htmlspecialchars($form_data['login'] ?? '') ?>">
                    <?= isset($validator) ? $validator->listErrors('login') : "" ?>
                </div>

                <div class="mb-3">
                    <label for="password">New password:</label>
                    <input type="password" class="form-control" id="password" name="password"
                        autocomplete="new-password">
                    <?= isset($validator) ? $validator->listErrors('password') : "" ?>

                    <label>
                        <input type="checkbox" class="password-checkbox" data-password-field="password">
                        Show password
                    </label>
                </div>

                <div class="mt-4 mb-3">
                    <label for="password_confirmation">Password confirmation:</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    <?= isset($validator) ? $validator->listErrors('password_confirmation') : "" ?>
                    <label>
                        <input type="checkbox" class="password-checkbox"
                            data-password-field="password_confirmation">Show password
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">Change the password</button>
            </form>
        </div>
    </div>
</main>
<script src="public/js/main.js" defer></script>

<?php
require_once VIEWS . '\components\footer.php';
?>