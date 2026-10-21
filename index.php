<?php
require 'DB.php';
require 'EmployeeService.php';
require 'helpers.php';

$db = new DB('employees.db');
$employeeService = new EmployeeService($db);

$employee_id = (int) ($_GET['employee_id'] ?? 1001);
$action = $_GET['action'] ?? 'manager';

$data = [
    'action' => $action,
];

$employee = $employeeService->getEmployee($employee_id);
$data['employee'] = $employee;

if ($employee) {
    switch ($action) {
        case 'manager':
            $data['manager'] = $employeeService->getManager($employee_id);
            break;
        case 'direct_reports':
            $data['directReports'] = $employeeService->getDirectReports($employee_id);
            break;
        case 'everyone_below':
            $data['fullTree'] = $employeeService->getReportTree($employee_id);
            break;
    }
}

echo render('views/employees.php', $data);
