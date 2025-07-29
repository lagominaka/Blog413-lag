<?php
require_once VIEWS . '\components\header.php';
?>
         <main class="container py-3">
            <div class="row">

               <div class="col-10">
 <form action="storage" method="POST" class="container col-lg-6 col-md-12 col-sm-12">
    <h3 class="mt-3">Registration</h3>

    <div class="mb-1">
    <label for="login" class="form-label">Login</label>
    <input type="text" class="form-control" id="login" name="login">
  </div>

  <div class="mb-1">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>

  <div class="mb-1">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>

  <div class="mb-3">
    <label for="password_confirmation" class="form-label">Confirm password</label>
    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
  </div>

<button type="submit" class="btn btn-success registration-button" name="reg_btn">Registration</button>

</form>
                  

                </div>

            </div>
         </main>
        
<?
require_once VIEWS . '\components\footer.php';
?>