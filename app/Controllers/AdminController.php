<?php
require_once 'app/Models/Employee.php';
require_once 'app/Models/User.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

class AdminController {
    public function __construct() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
            header("Location: " . URLROOT . "/auth/login");
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
        header("Location: " . URLROOT . "/admin/users");
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
            $filePath = $_FILES['file']['tmp_name'];
            $db = Database::getInstance();

            try {
                $spreadsheet = IOFactory::load($filePath);
                $worksheet = $spreadsheet->getActiveSheet();
                $rows = $worksheet->toArray();

                if (count($rows) > 0) {
                    $header = array_shift($rows);
                    $mapping = $this->getMapping($header);

                    foreach ($rows as $data) {
                        $matricule = trim($data[$mapping['matricule']] ?? '');
                        $ssn = trim($data[$mapping['ssn']] ?? '');

                        if (empty($matricule)) continue;

                        // Handle unique constraint for SSN (allow multiple NULLs but not multiple empty strings)
                        $ssnValue = !empty($ssn) ? $ssn : null;

                        $stmt = $db->prepare("INSERT INTO employees (structure, matricule, nom, prenom, nom_ar, prenom_ar, ssn, date_naissance) VALUES (?, ?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE structure=VALUES(structure), nom=VALUES(nom), prenom=VALUES(prenom), nom_ar=VALUES(nom_ar), prenom_ar=VALUES(prenom_ar), ssn=VALUES(ssn), date_naissance=VALUES(date_naissance)");

                        $stmt->execute([
                            $data[$mapping['structure']] ?? '',
                            $matricule,
                            $data[$mapping['nom']] ?? '',
                            $data[$mapping['prenom']] ?? '',
                            $data[$mapping['nom_ar']] ?? '',
                            $data[$mapping['prenom_ar']] ?? '',
                            $ssnValue,
                            $this->formatDate($data[$mapping['date_naissance']] ?? null)
                        ]);
                    }
                    $_SESSION['success'] = "تم استيراد البيانات بنجاح";
                }
            } catch (Exception $e) {
                $_SESSION['error'] = "خطأ في معالجة الملف: " . $e->getMessage();
            }

            header("Location: " . URLROOT . "/admin/employees");
            exit();
        }
    }

    private function getMapping($header) {
        $mapping = [
            'structure' => 1,
            'matricule' => 5,
            'nom' => 6,
            'prenom' => 7,
            'nom_ar' => 8,
            'prenom_ar' => 9,
            'ssn' => 32,
            'date_naissance' => 14
        ];

        foreach ($header as $i => $col) {
            if (!$col) continue;
            $col = trim($col);
            if ($col == 'الماتريكول' || $col == 'Matricule' || $col == 'matricule') $mapping['matricule'] = $i;
            if ($col == 'الاسم' || $col == 'Nom' || $col == 'nom') $mapping['nom_ar'] = $i;
            if ($col == 'اللقب' || $col == 'Prenom' || $col == 'prenom') $mapping['prenom_ar'] = $i;
            if ($col == 'رقم الضمان' || $col == 'SSN' || $col == 'ssn') $mapping['ssn'] = $i;
            if ($col == 'الهيكل' || $col == 'Structure' || $col == 'structure') $mapping['structure'] = $i;
            if ($col == 'تاريخ الميلاد' || $col == 'Date Naissance' || $col == 'date_naissance') $mapping['date_naissance'] = $i;
        }

        return $mapping;
    }

    private function formatDate($date) {
        if (!$date) return null;
        if (is_numeric($date) && $date > 10000) {
            return date('Y-m-d', ($date - 25569) * 86400);
        }
        $ts = strtotime($date);
        return $ts ? date('Y-m-d', $ts) : null;
    }
}
