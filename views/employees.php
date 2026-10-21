<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Data</title>
</head>
<body>
    <?php if (empty($employee)): ?>
        <p>No employee found.</p>
    <?php else: ?>
        <h1>Employee</h1>
        <p><?= e($employee['first_name'] . ' ' . $employee['last_name']) ?> — <?= e($employee['title']) ?></p>

        <?php if ($action === 'manager'): ?>
            <h2>Manager</h2>
            <?php if ($manager): ?>
                <p><?= e($manager['first_name'] . ' ' . $manager['last_name']) ?> — <?= e($manager['title']) ?></p>
            <?php else: ?>
                <p>No manager.</p>
            <?php endif; ?>

        <?php elseif ($action === 'direct_reports'): ?>
            <h2>Direct Reports</h2>
            <?php if (empty($directReports)): ?>
                <p>No direct reports.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($directReports as $report): ?>
                        <li><?= e($report['first_name'] . ' ' . $report['last_name']) ?> — <?= e($report['title']) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

        <?php elseif ($action === 'everyone_below'): ?>
            <h2>Everyone Below</h2>
            <?php if (empty($fullTree)): ?>
                <p>No one reports to this employee.</p>
            <?php else: ?>
                <?= renderReportTree($fullTree) ?>
            <?php endif; ?>

        <?php else: ?>
            <p>Unknown action "<?= e($action) ?>". Valid actions: manager, direct_reports, everyone_below.</p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
