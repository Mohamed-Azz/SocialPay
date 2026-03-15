<?php
require_once 'app/Models/Employee.php';

class PortalController {
    public function login() {
        require_once 'app/Views/portal/login.php';
    }

    public function auth() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ssn = $_POST['ssn'];
            $dob = $_POST['dob']; // Format: ddmmyyyy

            $employeeModel = new Employee();
            $employee = $employeeModel->verify($ssn, $dob);

            if ($employee) {
                $_SESSION['employee_id'] = $employee['id'];
                header("Location: /portal/dashboard");
                exit();
            } else {
                $_SESSION['error'] = "بيانات غير صحيحة";
                header("Location: /portal/login");
                exit();
            }
        }
    }

    public function dashboard() {
        if (!isset($_SESSION['employee_id'])) {
            header("Location: /portal/login");
            exit();
        }
        // ... Load dashboard logic
        require_once 'app/Views/portal/dashboard.php';
    }

    public function logout() {
        unset($_SESSION['employee_id']);
        header("Location: /portal/login");
        exit();
    }
}
