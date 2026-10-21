<?php

function dd($data)
{
    spit($data);
    die();
}

function spit($data)
{
    echo '<pre>' . print_r($data, true) . '</pre>';
}

function render(string $viewPath, array $data = [])
{
    extract($data);
    ob_start();
    include $viewPath;
    return ob_get_clean();
}

function e(string $str)
{
    return htmlspecialchars($str);
}

function renderReportTree(array $reports): string
{
    if (empty($reports)) {
        return '';
    }

    ob_start();
    ?>
    <ul>
        <?php foreach ($reports as $report): ?>
            <li>
                <?= e($report['first_name'] . ' ' . $report['last_name']) ?> — <?= e($report['title']) ?>
                <?= renderReportTree($report['direct_reports'] ?? []) ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php
    return ob_get_clean();
}
