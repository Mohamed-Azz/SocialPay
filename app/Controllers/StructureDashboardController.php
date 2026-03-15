<?php
// Extends StructureController
require_once 'app/Controllers/StructureController.php';

class StructureDashboardController extends StructureController {
    public function deductions() {
        $month = $_GET['month'] ?? date('Y-m');
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT i.*, e.nom_ar, e.ssn FROM installments i JOIN payments p ON i.payment_id = p.id JOIN requests r ON p.request_id = r.id JOIN employees e ON r.employee_id = e.id WHERE i.due_date LIKE ?");
        $stmt->execute(["$month%"]);
        $installments = $stmt->fetchAll();

        require_once 'app/Views/admin/deductions.php';
    }

    public function confirmDeduction() {
        if (isset($_GET['id'])) {
            $db = Database::getInstance();
            $db->beginTransaction();
            try {
                $stmt = $db->prepare("UPDATE installments SET is_paid = 1, paid_at = NOW() WHERE id = ?");
                $stmt->execute([$_GET['id']]);

                $stmt = $db->prepare("SELECT amount FROM installments WHERE id = ?");
                $stmt->execute([$_GET['id']]);
                $amount = $stmt->fetchColumn();

                $stmt = $db->query("UPDATE mandates SET budget = budget + $amount WHERE is_active = 1");

                $db->commit();
            } catch(Exception $e) {
                $db->rollBack();
            }
        }
        header("Location: " . URLROOT . "/structureDashboard/deductions");
    }

    public function printOrder() {
        if (isset($_GET['id'])) {
            $db = Database::getInstance();
            $stmt = $db->prepare("SELECT p.*, e.nom_ar, e.num_compte, g.name as grant_name FROM payments p JOIN requests r ON p.request_id = r.id JOIN employees e ON r.employee_id = e.id JOIN grants g ON r.grant_id = g.id WHERE p.id = ?");
            $stmt->execute([$_GET['id']]);
            $payment = $stmt->fetch();
            require_once 'app/Views/admin/payment_order.php';
        }
    }
}
