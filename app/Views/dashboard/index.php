<?= view('layouts/header') ?>
<style>
  body {
    background-color: #f5f7fa;
    font-family: 'Inter', sans-serif;
  }

  .tab-content .card {
    border: none;
    border-radius: 12px;
    transition: all 0.3s ease;
  }

  .tab-content .card:hover {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
  }

  .kanban-col {
    background-color: #fefefe;
    border-radius: 12px;
    padding: 10px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
  }

  .kanban-task {
    background-color: #ffffff;
    border-left: 5px solid;
    padding: 12px;
    border-radius: 10px;
    margin-bottom: 10px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    transition: transform 0.2s;
  }

  .kanban-task:hover {
    transform: scale(1.02);
  }

  .task-header {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 4px;
  }

  .task-meta {
    font-size: 0.85rem;
    color: #6c757d;
  }

.fc .fc-toolbar-title {
  font-size: 1.25rem;
  font-weight: 600;
  color: #343a40;
}

.fc .fc-button {
  font-size: 0.875rem;
  padding: 0.4rem 0.75rem;
  border-radius: 0.375rem;
}

.fc-event {
  border: none;
  background-color: #e9ecef !important;
  color: #212529 !important;
  font-size: 0.85rem;
  font-weight: 500;
  padding: 4px 6px;
  transition: all 0.2s;
}

.fc-event:hover {
  background-color: #dbe4ea !important;
  color: #000;
} 

#taskCalendar {
  background-color: #fff;
  border-radius: 12px;
  padding: 15px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.04);
}

</style>


<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-semibold text-dark mb-0">Hi <?= esc(session('user_name')) ?> 👋</h2>
    <div>
      <a href="<?= site_url('tasks/create') ?>" class="btn btn-sm btn-success me-2">+ Task</a>
      <a href="<?= site_url('projects/create') ?>" class="btn btn-sm btn-primary">+ Project</a>
    </div>
  </div>

  <ul class="nav nav-pills mb-4" id="dashboardTabs">
    <li class="nav-item">
      <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#summary">Summary</button>
    </li>
    <li class="nav-item">
      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#kanban">Kanban</button>
    </li>
    <li class="nav-item">
      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#calendar">Calendar</button>
    </li>
  </ul>

  <div class="tab-content">
    <!-- Summary Tab -->
    <div class="tab-pane fade show active" id="summary">
      <div class="row g-3 mb-4">
        <?php $colors = ['primary','success','info','warning','dark']; ?>
        <?php foreach ([
          ['Total Projects', $totalProjects],
          ['Total Tasks', $totalTasks],
          ['In Progress', $inProgressTasks],
          ['Pending', $pendingTasks],
          ['Completed', $completedTasks],
        ] as $i => [$label, $value]): ?>
        <div class="col-md">
          <div class="stat-card text-<?= $colors[$i] ?>">
            <small class="text-muted"><?= $label ?></small>
            <h4 class="fw-bold mt-1 mb-0"><?= $value ?></h4>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="card mb-4">
        <div class="card-header bg-white border-bottom"><strong>Upcoming Tasks</strong></div>
        <div class="table-responsive">
          <table class="table mb-0 align-middle">
            <thead>
              <tr><th>Title</th><th>Deadline</th><th>Status</th><th>Actions</th></tr>
            </thead>
            <tbody>
              <?php foreach ($upcomingTasks ?: [] as $task): ?>
                <tr>
                  <td><?= esc($task['title']) ?></td>
                  <td><?= esc($task['deadline']) ?></td>
                  <td><span class="badge bg-<?= $task['status'] === 'done' ? 'success' : ($task['status'] === 'in_progress' ? 'info' : 'warning') ?>"><?= ucfirst($task['status']) ?></span></td>
                  <td>
                    <a href="<?= site_url('tasks/edit/' . $task['id']) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                    <a href="<?= site_url('tasks/delete/' . $task['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</a>
                  </td>
                </tr>
              <?php endforeach; ?>
              <?php if (empty($upcomingTasks)): ?>
                <tr><td colspan="4" class="text-center text-muted">No upcoming tasks.</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="card">
        <div class="card-header bg-white border-bottom"><strong>Your Projects</strong></div>
        <div class="table-responsive">
          <table class="table mb-0 align-middle">
            <thead><tr><th>Name</th><th>Description</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
              <?php foreach ($myProjects ?: [] as $project): ?>
                <tr>
                  <td><?= esc($project['name']) ?></td>
                  <td><?= esc($project['description']) ?></td>
                  <td><span class="badge bg-<?= $project['status'] === 'active' ? 'success' : ($project['status'] === 'paused' ? 'warning' : 'secondary') ?>"><?= ucfirst($project['status']) ?></span></td>
                  <td>
                    <a href="<?= site_url('projects/edit/' . $project['id']) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                    <a href="<?= site_url('projects/delete/' . $project['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</a>
                  </td>
                </tr>
              <?php endforeach; ?>
              <?php if (empty($myProjects)): ?>
                <tr><td colspan="4" class="text-center text-muted">No projects found.</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

      <?php if (session('role') === 'admin' && !empty($users)): ?>
  <div class="card mt-4">
    <div class="card-header bg-white border-bottom">
      <strong>Users</strong>
    </div>
    <div class="table-responsive">
      <table class="table mb-0 align-middle">
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
              <td>
                <form action="<?= site_url('users/toggle-status/' . $user['id']) ?>" method="post">
                  <button type="submit" class="btn btn-sm <?= $user['status'] === 'active' ? 'btn-success' : 'btn-secondary' ?>">
                    <?= ucfirst($user['status']) ?>
                  </button>
                </form>
              </td>
              <td>
                <form action="<?= site_url('users/change-role/' . $user['id']) ?>" method="post">
                  <select name="role" onchange="this.form.submit()" class="form-select form-select-sm">
                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="manager" <?= $user['role'] === 'manager' ? 'selected' : '' ?>>Manager</option>
                    <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                  </select>
                </form>
              </td>
              <td>
                <?php if (session('role') === 'admin' && $user['id'] !== session('user_id')): ?>
                  <form action="<?= site_url('users/delete/' . $user['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                  </form>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
<?php endif; ?>


    </div>

   <!-- Kanban -->
<div class="tab-pane fade" id="kanban">
  <div class="row g-3">
    <?php
    $statusMap = [
      'pending' => ['label' => 'Pending', 'color' => '#ffc107'],
      'in_progress' => ['label' => 'In Progress', 'color' => '#17a2b8'],
      'done' => ['label' => 'Completed', 'color' => '#28a745'],
    ];
    ?>
    <?php foreach ($statusMap as $status => $data): ?>
      <div class="col-md-4">
        <div class="kanban-col">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="text-dark"><?= $data['label'] ?></h5>
            <span class="badge" style="background-color: <?= $data['color'] ?>"><?= ucfirst($status) ?></span>
          </div>
          <?php foreach ($allTasks as $task): ?>
            <?php if ($task['status'] === $status): ?>
              <div class="kanban-task" style="border-color: <?= $data['color'] ?>">
                <div class="d-flex justify-content-between">
                  <div class="task-header"><?= esc($task['title']) ?></div>
                  <div>
                    <a href="<?= site_url('tasks/edit/' . $task['id']) ?>" class="text-primary me-2">✏️</a>
                    <a href="<?= site_url('tasks/delete/' . $task['id']) ?>" onclick="return confirm('Delete?')" class="text-danger">🗑️</a>
                  </div>
                </div>
                <div class="task-meta">Due: <?= esc($task['deadline']) ?></div>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>


    <!-- Calendar -->
    <div class="tab-pane fade" id="calendar">
      <div id="taskCalendar" class="mt-3 border rounded shadow-sm p-2 bg-white"></div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('taskCalendar');

    const calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      height: 'auto',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,listWeek'
      },
      themeSystem: 'bootstrap5',
      dayMaxEvents: true,
      eventDisplay: 'block',
      eventTimeFormat: { hour: '2-digit', minute: '2-digit', hour12: false },

      eventDidMount: function(info) {
        // Tooltip or hover styling
        info.el.style.cursor = 'pointer';
        info.el.title = info.event.title + ' - ' + info.event.start.toLocaleDateString();
        info.el.classList.add('p-2', 'rounded');
      },

      events: [
        <?php $lastIndex = count($allTasks) - 1; foreach ($allTasks as $i => $task): ?>
        {
          title: '<?= addslashes($task['title']) ?>',
          start: '<?= $task['deadline'] ?>',
          url: '<?= site_url('tasks/edit/' . $task['id']) ?>',
          color: '<?= $task['status'] === 'done' ? '#28a745' : ($task['status'] === 'in_progress' ? '#17a2b8' : '#ffc107') ?>'
        }<?= $i < $lastIndex ? ',' : '' ?>
        <?php endforeach; ?>
      ]
    });

    calendar.render();
  });
</script>


<?= view('layouts/footer') ?>