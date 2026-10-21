<?php

class EmployeeService {
    public function __construct(private DB $db)
    {
    }

    public function getReportTree(int $employee_id): array
    {
        $reports = $this->getDirectReports($employee_id);
        foreach ($reports as &$report) {
            $children = $this->getReportTree($report['id']);
            if (!empty($children)) {
                $report['direct_reports'] = $children;
            }
        }
        return $reports;
    }

    public function getManager(int $employee_id)
    {
        $employee = $this->getEmployee($employee_id);
        return $employee && $employee['manager_id'] !== null ? $this->getEmployee($employee['manager_id']) : null;
    }

    public function getEmployee(int $employee_id)
    {
        $rows = $this->db->get('SELECT * FROM employees WHERE id = ? AND active = 1', [$employee_id]);
        return $rows[0] ?? null;
    }

    public function getDirectReports(int $employee_id)
    {
        return $this->db->get('SELECT id, first_name, last_name, title, manager_id FROM employees WHERE manager_id = ? AND active = 1', [$employee_id]);
    }
}
