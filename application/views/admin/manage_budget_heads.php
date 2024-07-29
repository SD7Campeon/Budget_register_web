<!DOCTYPE html>
<html>
<head>
    <title>Manage Budget Heads</title>
</head>
<body>
    <h2>Budget Heads</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Name</th>
                <th>Department Shortname</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($budget_heads as $budget_head): ?>
                <tr>
                    <td><?php echo $budget_head['id']; ?></td>
                    <td><?php echo $budget_head['code']; ?></td>
                    <td><?php echo $budget_head['name']; ?></td>
                    <td><?php echo $budget_head['dept_shortname']; ?></td>
                    <td>
                        <a href="<?php echo site_url('admin/delete_budget_head/' . $budget_head['id']); ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h3>Add Budget Head</h3>
    <?php echo validation_errors(); ?>
    <?php echo form_open('admin/add_budget_head'); ?>
    <label for="code">Code</label>
    <input type="text" name="code" id="code" placeholder="XX-XX-XX" /><br />
    <label for="name">Name</label>
    <input type="text" name="name" id="name" /><br />
    <label for="dept_shortname">Department Shortname</label>
    <input type="text" name="dept_shortname" id="dept_shortname" /><br />
    <input type="submit" value="Add Budget Head" />
    </form>
</body>
</html>
