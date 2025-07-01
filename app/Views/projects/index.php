<?= view('layouts/header') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
  <h3 class="fw-semibold text-dark mb-0">📁 All Projects</h3>
  <a href="<?= site_url('projects/create') ?>" class="btn btn-primary">+ New Project</a>
</div>

<div class="card shadow-sm">
  <div class="card-body p-0">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>Status</th>
          <th style="width: 150px;">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($projects): ?>
          <?php foreach ($projects as $project): ?>
            <tr>
              <td><?= esc($project['name']) ?></td>
              <td><?= esc($project['description']) ?></td>
              <td>
                <span class="badge bg-<?= 
                  $project['status'] === 'active' ? 'success' : 
                  ($project['status'] === 'paused' ? 'warning' : 'secondary') ?>">
                  <?= ucfirst($project['status']) ?>
                </span>
              </td>
              <td>
                <a href="<?= site_url('projects/edit/' . $project['id']) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                <a href="<?= site_url('projects/delete/' . $project['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this project?')">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="4" class="text-center text-muted py-3">No projects available.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?= view('layouts/footer') ?>
