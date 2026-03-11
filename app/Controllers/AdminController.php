<?php
require_once 'app/Models/Employee.php';
require_once 'app/Models/User.php';

class AdminController {
    public function __construct() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
            header("Location: /auth/login");
            exit();
        }
    }

    public function dashboard() {
        $db = Database::getInstance();
        $stmt = $db->query("SELECT r.*, e.nom_ar, g.name as grant_name FROM requests r JOIN employees e ON r.employee_id = e.id JOIN grants g ON r.grant_id = g.id");
        $allRequests = $stmt->fetchAll();

        $stmt = $db->query("SELECT p.*, r.status, e.nom_ar FROM payments p JOIN requests r ON p.request_id = r.id JOIN employees e ON r.employee_id = e.id");
        $studiedRequests = $stmt->fetchAll();

        require_once 'app/Views/admin/dashboard.php';
    }

    public function users() {
        $db = Database::getInstance();
        $stmt = $db->query("SELECT * FROM users");
        $users = $stmt->fetchAll();
        require_once 'app/Views/admin/users.php';
    }

    public function toggleUser() {
        if (isset($_GET['id'])) {
            $db = Database::getInstance();
            $stmt = $db->prepare("UPDATE users SET is_active = NOT is_active WHERE id = ?");
            $stmt->execute([$_GET['id']]);
        }
        header("Location: /admin/users");
    }

    public function employees() {
        $db = Database::getInstance();
        $stmt = $db->query("SELECT * FROM employees");
        $employees = $stmt->fetchAll();
        require_once 'app/Views/admin/employees.php';
    }

    public function mandates() {
        $db = Database::getInstance();
        $stmt = $db->query("SELECT * FROM mandates");
        $mandates = $stmt->fetchAll();
        require_once 'app/Views/admin/mandates.php';
    }

    public function grants() {
        $db = Database::getInstance();
        $stmt = $db->query("SELECT g.*, b.name as bab_name FROM grants g JOIN babs b ON g.bab_id = b.id");
        $grants = $stmt->fetchAll();
        $stmt = $db->query("SELECT * FROM babs");
        $babs = $stmt->fetchAll();
        require_once 'app/Views/admin/grants.php';
    }

    public function import() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
            $handle = fopen($_FILES['file']['tmp_name'], "r");
            $db = Database::getInstance();
            fgetcsv($handle);
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $stmt = $db->prepare("INSERT INTO employees (structure, matricule, nom, prenom, nom_ar, prenom_ar, ssn, date_naissance) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([
                    $data[1] ?? '',
                    $data[5] ?? '',
                    $data[6] ?? '',
                    $data[7] ?? '',
                    $data[8] ?? '',
                    $data[9] ?? '',
                    $data[32] ?? '',
                    $this->formatDate($data[14] ?? null)
                ]);
            }
            fclose($handle);
            header("Location: /admin/employees");
        }
    }

    private function formatDate($date) {
        if (!$date) return null;
        return date('Y-m-d', strtotime($date));
    }
}
