<?php
// Extends CommitteeController
require_once 'app/Controllers/CommitteeController.php';

class CommitteeDashboardController extends CommitteeController {
    public function viewOperations() {
        $db = Database::getInstance();
        $stmt = $db->query("SELECT p.*, e.nom_ar, r.status FROM payments p JOIN requests r ON p.request_id = r.id JOIN employees e ON r.employee_id = e.id ORDER BY p.payment_date DESC");
        $payments = $stmt->fetchAll();
        require_once 'app/Views/admin/operations_view.php';
    }
}
