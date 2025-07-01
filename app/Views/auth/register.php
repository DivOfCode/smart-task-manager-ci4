<?= view('layouts/header') ?>

<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
  <div class="card shadow-sm p-4" style="max-width: 400px; width: 100%;">
    <h3 class="text-center mb-4 fw-semibold text-dark">📝 Create an Account</h3>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
      </div>
    <?php endif; ?>
    <form method="post" action="<?= site_url('registerProcess') ?>">
      <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="John Doe" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="you@example.com" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Create Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
      </div>
 <!-- <div class="g-recaptcha" data-sitekey="6LepPmorAAAAABBvYx1CGbiwHqIasOb441rPG3zu"></div> -->
      <div class="d-grid">
        <button type="submit" class="btn btn-success">Register</button>
      </div>

      <div class="text-center mt-3">
        <a href="<?= site_url('login') ?>" class="text-decoration-none">Already have an account? <strong>Login</strong></a>
      </div>
    </form>
  </div>
</div>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?= view('layouts/footer') ?>
