<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Budget</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .table-container {
            zoom: 50%;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <h3>Budget Register</h3>
    </a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="btn btn-sm btn-outline-secondary" style="margin-right: 10px;" href="<?= site_url('user/dashboard'); ?>">
                    <h5>Dashboard</h5>
                </a>
            </li>
        </ul>
        <span class="navbar-text">
            <h3><?= $this->session->userdata('username'); ?> (<?= $this->session->userdata('dept_name'); ?>)</h3>
        </span>
        <a class="btn btn-outline-danger ml-2" href="<?= site_url('auth/logout'); ?>">
            <h5>Logout</h5>
        </a>
    </div>
</nav>

<div class="container">
    <h1 class="mt-5 text-center"><?php echo $budget_head->name; ?> (<?php echo $budget_head->code; ?>)</h1>
    <div class="row">
        <div class="col table-container">
            <h2>Budget Table</h2>
            <form id="budgetForm">
                <table id="budgetTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Proposal Amount</th>
                            <th>Provision Availed</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($budgets as $budget): ?>
                            <tr>
                                <td><?php echo $budget->date; ?></td>
                                <td><?php echo $budget->description; ?></td>
                                <td><?php echo $budget->proposal_amount; ?></td>
                                <td><?php echo $budget->provision_availed; ?></td>
                                <td><?php echo $budget->balance; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td><input type="date" class="form-control" name="date" required></td>
                            <td><input type="text" class="form-control" name="description" required></td>
                            <td><input type="number" step="0.01" class="form-control" name="proposal_amount" required onchange="updateBalance()"></td>
                            <td><input type="number" step="0.01" class="form-control" name="provision_availed" required onchange="updateBalance()"></td>
                            <td><input type="number" step="0.01" class="form-control" name="balance" readonly></td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
        <div class="col table-container">
            <h2>Expenditure Table</h2>
            <form id="expenditureForm">
                <table id="expenditureTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Party Name</th>
                            <th>Expenditure</th>
                            <th>Total Expenditure</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($expenditures as $expenditure): ?>
                            <tr>
                                <td><?php echo $expenditure->date; ?></td>
                                <td><?php echo $expenditure->description; ?></td>
                                <td><?php echo $expenditure->partyname; ?></td>
                                <td><?php echo $expenditure->expenditure; ?></td>
                                <td><?php echo $expenditure->total_expenditure; ?></td>
                                <td><?php echo $expenditure->balance; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td><input type="date" class="form-control" name="date" required></td>
                            <td><input type="text" class="form-control" name="description" required></td>
                            <td><input type="text" class="form-control" name="partyname" required></td>
                            <td><input type="number" step="0.01" class="form-control" name="expenditure" required onchange="calculateExpenditureBalance()"></td>
                            <td><input type="number" step="0.01" class="form-control" name="total_expenditure" required onchange="calculateExpenditureBalance()"></td>
                            <td><input type="number" step="0.01" class="form-control" name="balance" readonly></td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>

<script>
    function updateBalance() {
        const rows = document.querySelectorAll('#budgetTable tbody tr');
        let previousBalance = 4125500.00;

        rows.forEach(row => {
            const proposalAmount = parseFloat(row.querySelector('input[name="proposal_amount"]').value) || 0;
            const provisionAvailed = parseFloat(row.querySelector('input[name="provision_availed"]').value) || 0;
            const balanceField = row.querySelector('input[name="balance"]');

            if (balanceField) {
                const balance = previousBalance - proposalAmount;
                balanceField.value = balance.toFixed(2);
                previousBalance = balance;
            }
        });
    }

    function calculateExpenditureBalance() {
        const rows = document.querySelectorAll('#expenditureTable tbody tr');

        rows.forEach(row => {
            const expenditure = parseFloat(row.querySelector('input[name="expenditure"]').value) || 0;
            const totalExpenditure = parseFloat(row.querySelector('input[name="total_expenditure"]').value) || 0;
            const balanceField = row.querySelector('input[name="balance"]');

            if (balanceField) {
                const balance = totalExpenditure - expenditure;
                balanceField.value = balance.toFixed(2);
            }
        });
    }

    function saveRow(form, url) {
        const data = new FormData(form);
        fetch(url, {
            method: 'POST',
            body: data
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Data successfully saved');
                const tbody = form.querySelector('tbody');
                const newRow = document.createElement('tr');
                form.querySelectorAll('input').forEach(input => {
                    const td = document.createElement('td');
                    td.textContent = input.value;
                    newRow.appendChild(td);
                    input.value = '';
                });
                tbody.insertBefore(newRow, tbody.lastElementChild);
            } else {
                alert('Failed to save data: ' + data.message);
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('An error occurred while saving data');
        });
    }

    document.getElementById('budgetForm').addEventListener('submit', function(e) {
        e.preventDefault();
        saveRow(this, '<?= base_url('user/add_budget/' . $budget_head->id); ?>');
    });

    document.getElementById('expenditureForm').addEventListener('submit', function(e) {
        e.preventDefault();
        saveRow(this, '<?= base_url('user/add_expenditure/' . $budget_head->id); ?>');
    });
</script>
</body>
</html>
