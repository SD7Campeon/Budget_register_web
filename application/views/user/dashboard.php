<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">BUDGET REGISTER</a>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Username: <?php echo $username; ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Department: <?php echo $department; ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-danger text-white" href="<?php echo base_url('auth/logout'); ?>">Logout</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="jumbotron mt-5">
        <h1 class="display-4">User Dashboard</h1>
        <p class="lead">Select a Budget Head to manage</p>
        <hr class="my-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($budget_heads as $budget_head): ?>
                    <tr>
                        <td><?php echo $budget_head->code; ?></td>
                        <td><?php echo $budget_head->name; ?></td>
                        <td>
                            <a href="<?php echo base_url('user/view_budget/'.$budget_head->id); ?>" class="btn btn-primary">Open Table</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
