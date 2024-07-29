<!DOCTYPE html>
<html>
<head>
    <title>Manage Departments</title>
</head>
<body>
    <h2>Departments</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Department Name</th>
                <th>Department Shortname</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($departments as $department): ?>
                <tr>
                    <td><?php echo $department['id']; ?></td>
                    <td><?php echo $department['dept_name']; ?></td>
                    <td><?php echo $department['dept_shortname']; ?></td>
                    <td>
                        <a href="<?php echo site_url('admin/delete_department/' . $department['id']); ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h3>Add Department</h3>
    <?php echo validation_errors(); ?>
    <?php echo form_open('admin/add_department'); ?>
    <label for="dept_name">Department Name</label>
    <input type="text" name="dept_name" id="dept_name" /><br />
    <label for="dept_shortname">Department Shortname</label>
    <input type="text" name="dept_shortname" id="dept_shortname" /><br />
    <input type="submit" value="Add Department" />
    </form>
</body>
</html>
