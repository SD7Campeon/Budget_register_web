<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="card mt-5">
        <div class="card-body">
            <h3 class="card-title">Signup</h3>
            <form action="<?php echo base_url('auth/register'); ?>" method="post">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="dept_shortname">Department</label>
                    <select class="form-control" id="dept_shortname" name="dept_shortname">
                        <?php foreach ($departments as $department): ?>
                            <option value="<?php echo $department->dept_shortname; ?>"><?php echo $department->dept_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Signup</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
