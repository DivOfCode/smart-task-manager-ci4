<?= view('layouts/header') ?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-light">
          <h4 class="mb-0 fw-semibold text-dark">📝 Create New Task</h4>
        </div>

        <div class="card-body">
          <form method="post" action="<?= site_url('tasks/store') ?>">

            <div class="mb-3">
              <label class="form-label">Title <span class="text-danger">*</span></label>
              <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea name="description" class="form-control" rows="4"></textarea>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Priority <span class="text-danger">*</span></label>
                <select name="priority" class="form-select" required>
                  <option value="low">Low</option>
                  <option value="medium">Medium</option>
                  <option value="high">High</option>
                </select>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select" required>
                  <option value="pending">Pending</option>
                  <option value="in_progress">In Progress</option>
                  <option value="done">Done</option>
                </select>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Deadline <span class="text-danger">*</span></label>
              <input type="date" name="deadline" class="form-control" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Project <span class="text-danger">*</span></label>
              <select name="project_id" class="form-select" required>
                <?php foreach ($projects as $p): ?>
                  <option value="<?= $p['id'] ?>"><?= esc($p['name']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-4">
              <label class="form-label">Assign To <span class="text-danger">*</span></label>
              <select name="assigned_to" class="form-select" required>
                <?php foreach ($users as $u): ?>
                  <option value="<?= $u['id'] ?>"><?= esc($u['name']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="d-flex justify-content-between">
              <a href="<?= site_url('tasks') ?>" class="btn btn-outline-secondary">← Cancel</a>
              <button type="submit" class="btn btn-primary">💾 Save Task</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?= view('layouts/footer') ?>
