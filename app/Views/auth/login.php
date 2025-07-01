<?= view('layouts/header') ?>

<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
  <div class="card shadow-sm p-4" style="max-width: 400px; width: 100%;">
    <h3 class="text-center mb-4 fw-semibold text-dark">🔐 Login to Your Account</h3>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
      </div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('loginProcess') ?>">
      <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="you@example.com" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Login</button>
      </div>

      <div class="text-center mt-3">
        <a href="<?= site_url('register') ?>" class="text-decoration-none">Don’t have an account? <strong>Register</strong></a>
      </div>
    </form>
  </div>
</div>

<?= view('layouts/footer') ?>
