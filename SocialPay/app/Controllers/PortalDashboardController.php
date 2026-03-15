<?php
// Extends PortalController
require_once 'app/Controllers/PortalController.php';

class PortalDashboardController extends PortalController {
    public function index() {
        if (!isset($_SESSION['employee_id'])) {
            header("Location: /portal/login");
            exit();
        }

        $db = Database::getInstance();
        $employeeId = $_SESSION['employee_id'];

        // Employee data
        $stmt = $db->prepare("SELECT * FROM employees WHERE id = ?");
        $stmt->execute([$employeeId]);
        $employee = $stmt->fetch();

        // Active Mandate
        $stmt = $db->query("SELECT * FROM mandates WHERE is_active = 1");
        $mandate = $stmt->fetch();

        // Available Grants
        $stmt = $db->query("SELECT g.*, b.name as bab_name FROM grants g JOIN babs b ON g.bab_id = b.id");
        $grants = $stmt->fetchAll();

        // User Requests
        $stmt = $db->prepare("SELECT r.*, g.name as grant_name FROM requests r JOIN grants g ON r.grant_id = g.id WHERE r.employee_id = ? ORDER BY r.created_at DESC");
        $stmt->execute([$employeeId]);
        $requests = $stmt->fetchAll();

        require_once 'app/Views/portal/dashboard.php';
    }

    public function submitRequest() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['employee_id'])) {
            $db = Database::getInstance();
            $employeeId = $_SESSION['employee_id'];
            $grantId = $_POST['grant_id'];

            // Check active mandate
            $stmt = $db->query("SELECT * FROM mandates WHERE is_active = 1");
            $mandate = $stmt->fetch();
            if (!$mandate) die("لا توجد عهدة نشطة");

            // Loan check
            $stmt = $db->prepare("SELECT b.type FROM grants g JOIN babs b ON g.bab_id = b.id WHERE g.id = ?");
            $stmt->execute([$grantId]);
            $grantType = $stmt->fetchColumn();

            if ($grantType != 'grant') {
                $stmt = $db->prepare("SELECT COUNT(*) FROM installments i JOIN payments p ON i.payment_id = p.id JOIN requests r ON p.request_id = r.id WHERE r.employee_id = ? AND i.is_paid = 0");
                $stmt->execute([$employeeId]);
                if ($stmt->fetchColumn() > 0) {
                    $_SESSION['error'] = "لا يمكنك طلب سلفة جديدة حتى تسديد السابقة";
                    header("Location: /portal/dashboard");
                    exit();
                }
            }

            // File upload
            $filePath = '';
            if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] == 0) {
                $filePath = 'uploads/' . time() . '_' . $_FILES['pdf']['name'];
                move_uploaded_file($_FILES['pdf']['tmp_name'], $filePath);
            }

            $stmt = $db->prepare("INSERT INTO requests (employee_id, grant_id, mandate_id, file_path) VALUES (?, ?, ?, ?)");
            $stmt->execute([$employeeId, $grantId, $mandate['id'], $filePath]);

            $_SESSION['success'] = "تم تقديم الطلب بنجاح";
            header("Location: /portal/dashboard");
            exit();
        }
    }
}
