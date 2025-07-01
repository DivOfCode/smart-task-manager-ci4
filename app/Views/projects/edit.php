<?= view('layouts/header') ?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-light">
          <h4 class="mb-0 fw-semibold text-dark">✏️ Edit Project</h4>
        </div>

        <div class="card-body">
          <form action="<?= site_url('projects/update/' . $project['id']) ?>" method="post">
            <div class="mb-3">
              <label for="name" class="form-label">Project Name <span class="text-danger">*</span></label>
              <input type="text" name="name" id="name" class="form-control" value="<?= esc($project['name']) ?>" required>
            </div>

            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea name="description" id="description" class="form-control" rows="4"><?= esc($project['description']) ?></textarea>
            </div>

            <div class="mb-3">
              <label for="status" class="form-label">Status</label>
              <select name="status" id="status" class="form-select">
                <option value="active" <?= $project['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                <option value="paused" <?= $project['status'] === 'paused' ? 'selected' : '' ?>>Paused</option>
                <option value="completed" <?= $project['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
              </select>
            </div>

            <div class="d-flex justify-content-between">
              <a href="<?= site_url('projects') ?>" class="btn btn-outline-secondary">← Cancel</a>
              <button type="submit" class="btn btn-primary">💾 Update Project</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?= view('layouts/footer') ?>
