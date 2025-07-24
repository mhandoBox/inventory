<?php
<!DOCTYPE html>
<html>
<head>
    <title>Income Statement</title>
</head>
<body>
    <h2>Income Statement</h2>
    <table border="1">
        <tr>
            <th>Account</th>
            <th>Debit</th>
            <th>Credit</th>
        </tr>
        <?php foreach($income_statement as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= number_format($row['debit'], 2) ?></td>
            <td><?= number_format($row['credit'], 2) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>