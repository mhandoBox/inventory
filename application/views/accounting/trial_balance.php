<?php
<!DOCTYPE html>
<html>
<head>
    <title>Trial Balance</title>
</head>
<body>
    <h2>Trial Balance</h2>
    <table border="1">
        <tr>
            <th>Account</th>
            <th>Type</th>
            <th>Total Debit</th>
            <th>Total Credit</th>
        </tr>
        <?php foreach($trial_balance as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['type']) ?></td>
            <td><?= number_format($row['total_debit'], 2) ?></td>
            <td><?= number_format($row['total_credit'], 2) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>