<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?? "Blog413" ?></title>
  <base href="<?= PATH ?>/">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="public/assets/main.css">

</head>

<body>
  <div class="wrapper">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container">
        <a class="navbar-brand" href="">Blog413</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contacts">Contacts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="posts/create">New Post</a>
            </li>
          </ul>
          <div class="ms-auto">
            <a href="users" class="btn btn-success registration-button" role="button">Registration</a>
           </div>
          <div class="ms-auto">
            <a href="users/login" class="btn btn-success" role="button">Log in</a>
            </div>
        </div>
     
    </nav>
  
    <? getAlerts(); ?>