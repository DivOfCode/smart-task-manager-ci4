<?= view('layouts/header') ?>

<div class="container mt-4">
  <h2 class="mb-4">User Management</h2>

  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Status</th>
        <th>Role</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user): ?>
        <tr>
          <td><?= esc($user['name']) ?></td>
          <td><?= esc($user['email']) ?></td>

          <!-- Status Column -->
          <td>
            <?php if (session('role') === 'admin'): ?>
              <form action="<?= site_url('users/toggle-status/' . $user['id']) ?>" method="post">
                <button type="submit" class="btn btn-sm <?= $user['status'] == 'active' ? 'btn-success' : 'btn-secondary' ?>">
                  <?= ucfirst($user['status']) ?>
                </button>
              </form>
            <?php else: ?>
              <span class="badge bg-<?= $user['status'] == 'active' ? 'success' : 'secondary' ?>">
                <?= ucfirst($user['status']) ?>
              </span>
            <?php endif; ?>
          </td>

          <!-- Role Column -->
          <td>
            <?php if (session('role') === 'admin'): ?>
              <form action="<?= site_url('users/change-role/' . $user['id']) ?>" method="post">
                <select name="role" onchange="this.form.submit()" class="form-select form-select-sm">
                  <option <?= $user['role'] == 'admin' ? 'selected' : '' ?> value="admin">Admin</option>
                  <option <?= $user['role'] == 'manager' ? 'selected' : '' ?> value="manager">Manager</option>
                  <option <?= $user['role'] == 'user' ? 'selected' : '' ?> value="user">User</option>
                </select>
              </form>
            <?php else: ?>
              <?= ucfirst($user['role']) ?>
            <?php endif; ?>
          </td>

          <!-- Admin Only: Delete Action -->
          <td>
            <?php if (session('role') === 'admin'): ?>
              <form action="<?= site_url('users/delete/' . $user['id']) ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this user?');">
                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
              </form>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?= view('layouts/footer') ?>
