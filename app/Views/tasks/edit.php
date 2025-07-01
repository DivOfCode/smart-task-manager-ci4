<?= view('layouts/header') ?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-light">
          <h4 class="mb-0 fw-semibold text-dark">✏️ Edit Task</h4>
        </div>

        <div class="card-body">
          <form method="post" action="<?= site_url('tasks/update/' . $task['id']) ?>">

            <div class="mb-3">
              <label class="form-label">Title <span class="text-danger">*</span></label>
              <input type="text" name="title" class="form-control" value="<?= esc($task['title']) ?>" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea name="description" class="form-control" rows="4"><?= esc($task['description']) ?></textarea>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Priority <span class="text-danger">*</span></label>
                <select name="priority" class="form-select" required>
                  <option value="low" <?= $task['priority'] === 'low' ? 'selected' : '' ?>>Low</option>
                  <option value="medium" <?= $task['priority'] === 'medium' ? 'selected' : '' ?>>Medium</option>
                  <option value="high" <?= $task['priority'] === 'high' ? 'selected' : '' ?>>High</option>
                </select>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select" required>
                  <option value="pending" <?= $task['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                  <option value="in_progress" <?= $task['status'] === 'in_progress' ? 'selected' : '' ?>>In Progress</option>
                  <option value="done" <?= $task['status'] === 'done' ? 'selected' : '' ?>>Done</option>
                </select>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Deadline <span class="text-danger">*</span></label>
              <input type="date" name="deadline" class="form-control" value="<?= esc($task['deadline']) ?>" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Project <span class="text-danger">*</span></label>
              <select name="project_id" class="form-select" required>
                <?php foreach ($projects as $p): ?>
                  <option value="<?= $p['id'] ?>" <?= $task['project_id'] == $p['id'] ? 'selected' : '' ?>>
                    <?= esc($p['name']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-4">
              <label class="form-label">Assign To <span class="text-danger">*</span></label>
              <select name="assigned_to" class="form-select" required>
                <?php foreach ($users as $u): ?>
                  <option value="<?= $u['id'] ?>" <?= $task['assigned_to'] == $u['id'] ? 'selected' : '' ?>>
                    <?= esc($u['name']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="d-flex justify-content-between">
              <a href="<?= site_url('tasks') ?>" class="btn btn-outline-secondary">← Cancel</a>
              <button type="submit" class="btn btn-primary">💾 Update Task</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?= view('layouts/footer') ?>
