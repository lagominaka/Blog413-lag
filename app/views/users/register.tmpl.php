<?php
require_once VIEWS . '\components\header.php';
?>
<main class="container py-3">
  <div class="row">
    <div class="col-10">
      <form action="users" method="POST" class="container col-lg-6 col-md-12 col-sm-12">
        <h3 class="mt-3">Registration</h3>

        <div class="mt-2">
          <label for="login" class="form-label">Login</label>
          <input type="text" class="form-control" id="login" name="login" value="<?= htmlspecialchars($form_data['login'] ?? '') ?>">
          <div id="loginHelp" class="form-text">The password must be at least 5 characters long.</div>
          <?= isset($validator) ? $validator->listErrors('login') : "" ?>
        </div>

        <div class="mt-2">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email" autocomplete="off" aria-describedby="emailHelp" value="<?= htmlspecialchars($form_data['email'] ?? '') ?>">
          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          <?= isset($validator) ? $validator->listErrors('email') : "" ?>
        </div>

        <div class="mt-2">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" autocomplete="new-password" value="<?= htmlspecialchars($form_data['password'] ?? '') ?>">
          <?= isset($validator) ? $validator->listErrors('password') : "" ?>
        </div>
        <div id="passwordHelp" class="form-text">The password must contain (at least 6 characters, including at least one uppercase letter, one digit, and one special character)</div>
        <label>
          <input type="checkbox" class="password-checkbox" data-password-field="password">
          Показать пароль
        </label>


        <div class="mt-3 mb-3">
          <label for="password_confirmation" class="form-label">Confirm password</label>
          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="<?= htmlspecialchars($form_data['password_confirmation'] ?? '') ?>">
          <?= isset($validator) ? $validator->listErrors('password_confirmation') : "" ?>
          <label>
            <input type="checkbox" class="password-checkbox" data-password-field="password_confirmation">Показать пароль
          </label>
        </div>

        <button type="submit" class="btn btn-success registration-button" name="reg_btn">Registration</button>

      </form>
    </div>

  </div>

  </div>
</main>
<script src="public/js/main.js" defer></script>


<?
require_once VIEWS . '\components\footer.php';
?>