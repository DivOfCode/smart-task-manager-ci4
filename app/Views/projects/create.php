<?= view('layouts/header') ?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-light">
          <h4 class="mb-0 fw-semibold text-dark">📁 Create New Project</h4>
        </div>

        <div class="card-body">
          <form action="<?= site_url('projects/store') ?>" method="post">
            <div class="mb-3">
              <label for="name" class="form-label">Project Name <span class="text-danger">*</span></label>
              <input type="text" name="name" id="name" class="form-control" placeholder="Enter project title" required>
            </div>

            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea name="description" id="description" class="form-control" rows="4" placeholder="Brief description..."></textarea>
            </div>

            <div class="d-flex justify-content-between">
              <a href="<?= site_url('projects') ?>" class="btn btn-outline-secondary">← Back</a>
              <button type="submit" class="btn btn-primary">💾 Save Project</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?= view('layouts/footer') ?>
