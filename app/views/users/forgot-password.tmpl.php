<?php
require_once VIEWS . '\components\header.php';
?>
<main class="container py-3">
  <div class="row">
    <div class="col-10">
      <form action="users/forgot-password" method="POST" class="container col-lg-6 col-md-12 col-sm-12">
        <h3 class="mt-3 mb-3">Password Reset</h3>
        <div class="mb-3">
             <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>
      <button type="submit" class="btn btn-primary" name="log_btn" value="login">Reset password</button>
    </div>
      </form>
    </div>
  </div>
</main>

<?
require_once VIEWS . '\components\footer.php';
?>