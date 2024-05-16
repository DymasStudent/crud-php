<?php

include 'config/app.php';

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">

  <!-- fontawesome cdn -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"">

  <title>
    <?= $title ?>
  </title>
</head>

<body>

  <div>
    <nav class=" navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">CRUD-PHP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <?php if ($_SESSION['level'] == 1 or $_SESSION['level'] == 2): ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php">Administrasi</a>
          </li>
        <?php endif; ?>

        <?php if ($_SESSION['level'] == 1 or $_SESSION['level'] == 3): ?>
          <li class="nav-item">
            <a class="nav-link" href="pegawai.php">Pegawai</a>
          </li>
        <?php endif; ?>

        <li class="nav-item">
          <a class="nav-link" href="crud-modal.php">Modal</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="logout.php" onclick="return confirm('Yakin ingin Keluar ?')">Keluar</a>
        </li>

      </ul>
    </div>

    <div>
      <a class="navbar-brand" href="#"><?= $_SESSION['nama']; ?></a>
    </div>
  </div>
  </nav>
  </div>