<?php
class CommitteeController {
    public function __construct() {
        if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['chairman', 'member', 'admin'])) {
            header("Location: /auth/login");
            exit();
        }
    }

    public function requests() {
        $db = Database::getInstance();
        $stmt = $db->query("SELECT r.*, e.nom_ar, e.prenom_ar, g.name as grant_name FROM requests r JOIN employees e ON r.employee_id = e.id JOIN grants g ON r.grant_id = g.id ORDER BY r.created_at DESC");
        $requests = $stmt->fetchAll();
        require_once 'app/Views/admin/requests_study.php';
    }

    public function process() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['role'] == 'chairman') {
            $requestId = $_POST['request_id'];
            $status = $_POST['status']; // beneficiary, rejected_temp, rejected_final
            $reason = $_POST['reason'] ?? '';

            $db = Database::getInstance();
            $stmt = $db->prepare("UPDATE requests SET status = ?, rejection_reason = ? WHERE id = ?");
            $stmt->execute([$status, $reason, $requestId]);

            header("Location: /committee/requests");
            exit();
        }
    }
}
