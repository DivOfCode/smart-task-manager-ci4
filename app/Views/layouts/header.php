<!DOCTYPE html>
<html>
<head>
  <title>Task Manager</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- FullCalendar -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

  <!-- Optional: Inter font for modern look -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f8f9fa;
    }
    .navbar-brand {
      font-weight: 600;
      font-size: 1.25rem;
      letter-spacing: 0.5px;
    }
    .navbar {
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
      background-color: #ffffff !important;
      border-bottom: 1px solid #eaeaea;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
  <div class="container-fluid px-3">
    <a class="navbar-brand text-dark" href="<?= site_url('/') ?>">Task Manager</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
       <?php if (session()->has('user_id')): ?>
      <ul class="navbar-nav me-3">
        <li class="nav-item">
          <a class="nav-link text-dark" href="<?= site_url('tasks') ?>">Tasks</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="<?= site_url('projects') ?>">Projects</a>
        </li>
      <?php if (session('role') === 'admin'): ?>
        <li class="nav-item">
          <a class="nav-link text-dark" href="<?= site_url('users') ?>">Manage Users</a>
        </li>
      <?php endif; ?>
      </ul>

     
        <div class="dropdown">
          <a href="#" class="text-dark text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            👤 <?= esc(session('user_name')) ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="<?= site_url('logout') ?>">Logout</a></li>
          </ul>
        </div>
      <?php endif; ?>
    </div>
  </div>
</nav>



<!-- Main Container -->
<div class="container mt-4">
