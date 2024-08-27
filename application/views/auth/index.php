<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Budget Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="jumbotron mt-5">
        <h1 class="display-4">Budget Register</h1>
        <p class="lead">Welcome to the Budget Register System.</p>
        <hr class="my-4">
        <p>Choose an option to continue:</p>
        <a class="btn btn-primary btn-lg" href="<?php echo base_url('auth/login'); ?>" role="button">Login</a>
        <a class="btn btn-secondary btn-lg" href="<?php echo base_url('auth/admin_login'); ?>" role="button">Admin Login</a>
        <a class="btn btn-success btn-lg" href="<?php echo base_url('auth/signup'); ?>" role="button">Signup</a>
    </div>
</div>
</body>
</html>

