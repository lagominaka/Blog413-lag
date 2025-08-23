<?php


require_once VIEWS . '\components\header.php';
?>
<main class="container py-3">
  <div class="row">
    <div class="col-10">
      <form action="users/login" method="POST" class="container col-lg-6 col-md-12 col-sm-12">
        <h3 class="mt-3 mb-3">Authorize</h3>
        <div class="mb-3">
          <label for="login" class="form-label">Login</label>
          <input type="text" class="form-control" id="login" name="login"
            value="<?= htmlspecialchars($form_data['login'] ?? '') ?>">
          <?= isset($validator) ? $validator->listErrors('login') : "" ?>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password"
            value="<?= htmlspecialchars($form_data['password'] ?? '') ?>">
          <?= isset($validator) ? $validator->listErrors('password') : "" ?>
          <label>
          <input type="checkbox" class="password-checkbox" data-password-field="password">
          Show password
        </label><br>   
          <a href="users/reset-password">Forgot your password?</a><br>

        </div>
        <button type="submit" class="btn btn-primary" name="log_btn" value="login">Login</button>
        <p class="mt-3">

         Don't you have an account? - <a href="users">Register</a>!
          </p>
      </form>
    </div>
  </div>
</main>
<script src="public/js/main.js" defer></script>
<?
require_once VIEWS . '\components\footer.php';
?>