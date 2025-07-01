<?= view('layouts/header') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
  <h3 class="fw-semibold text-dark mb-0">📝 All Tasks</h3>
  <a href="<?= site_url('tasks/create') ?>" class="btn btn-primary">+ New Task</a>
</div>

<div class="card shadow-sm">
  <div class="card-body p-0">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th>Title</th>
          <th>Deadline</th>
          <th>Status</th>
          <th>Project</th>
          <th style="width: 150px;">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($tasks): ?>
          <?php foreach ($tasks as $task): ?>
            <tr>
              <td><?= esc($task['title']) ?></td>
              <td><?= esc($task['deadline']) ?></td>
              <td>
                <span class="badge bg-<?= 
                  $task['status'] === 'done' ? 'success' : 
                  ($task['status'] === 'in_progress' ? 'info' : 'warning') ?>">
                  <?= ucfirst($task['status']) ?>
                </span>
              </td>
              <td><?= esc($task['project_name'] ?? '-') ?></td>
              <td>
                <a href="<?= site_url('tasks/edit/' . $task['id']) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                <a href="<?= site_url('tasks/delete/' . $task['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this task?')">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="5" class="text-center text-muted py-3">No tasks found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?= view('layouts/footer') ?>
