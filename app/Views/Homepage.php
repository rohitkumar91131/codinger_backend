<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Academix - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="/">Academix</a>
  </div>
</nav>

<div class="container my-5">
    <h1 class="mb-4 text-center">Welcome to Academix</h1>
    <p class="text-center text-muted">Manage Teachers & Users in one place</p>

    <!-- Teachers Table -->
    <div class="card shadow-sm mb-5">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Teachers</h5>
        </div>
        <div class="card-body">
            <?php if (!empty($teachers)): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Teacher Name</th>
                            <th>Subject</th>
                            <th>Email (User)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($teachers as $t): ?>
                            <tr>
                                <td><?= $t['id'] ?></td>
                                <td><?= $t['name'] ?></td>
                                <td><?= $t['subject'] ?></td>
                                <td><?= $t['email'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-muted">No teachers found.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Users Table -->
    <div class="card shadow-sm mb-5">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Users</h5>
        </div>
        <div class="card-body">
            <?php
            // Fetch users via Auth controller
            $users = (new \App\Controllers\Auth())->sendAllUser();
            ?>
            <?php if (!empty($users)): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $u): ?>
                            <tr>
                                <td><?= $u['id'] ?></td>
                                <td><?= $u['first_name'] . ' ' . $u['last_name'] ?></td>
                                <td><?= $u['email'] ?></td>
                                <td><?= $u['role'] ?? 'N/A' ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-muted">No users found.</p>
            <?php endif; ?>
        </div>
    </div>

</div>

<footer class="bg-dark text-white text-center py-3">
    &copy; <?= date('Y') ?> Academix. All rights reserved.
</footer>

</body>
</html>
