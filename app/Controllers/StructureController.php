<?php
class StructureController {
    public function __construct() {
        if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['accountant', 'manager', 'admin'])) {
            header("Location: /auth/login");
            exit();
        }
    }

    public function payments() {
        $db = Database::getInstance();
        $stmt = $db->query("SELECT r.*, e.nom_ar, e.prenom_ar, e.num_compte, g.amount as grant_amount, g.name as grant_name FROM requests r JOIN employees e ON r.employee_id = e.id JOIN grants g ON r.grant_id = g.id WHERE r.status = 'beneficiary' AND r.id NOT IN (SELECT request_id FROM payments)");
        $pendingPayments = $stmt->fetchAll();
        require_once 'app/Views/admin/payments.php';
    }

    public function pay() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $requestId = $_POST['request_id'];
            $amount = $_POST['amount'];
            $fees = $_POST['fees'];

            $db = Database::getInstance();
            $db->beginTransaction();
            try {
                // Insert payment
                $stmt = $db->prepare("INSERT INTO payments (request_id, user_id, amount, bank_fees, payment_date, reference_number) VALUES (?, ?, ?, ?, CURDATE(), ?)");
                $ref = 'PAY-' . time();
                $stmt->execute([$requestId, $_SESSION['user_id'], $amount, $fees, $ref]);
                $paymentId = $db->lastInsertId();

                // Update mandate budget
                $stmt = $db->prepare("UPDATE mandates SET budget = budget - ? WHERE is_active = 1");
                $stmt->execute([$amount + $fees]);

                // Create installments if loan
                $stmt = $db->prepare("SELECT g.installments_count, g.repayment_percentage FROM requests r JOIN grants g ON r.grant_id = g.id WHERE r.id = ?");
                $stmt->execute([$requestId]);
                $grant = $stmt->fetch();

                if ($grant['installments_count'] > 0) {
                    $totalRepay = $amount * ($grant['repayment_percentage'] / 100);
                    $instAmount = $totalRepay / $grant['installments_count'];

                    for ($i = 1; $i <= $grant['installments_count']; $i++) {
                        $stmt = $db->prepare("INSERT INTO installments (payment_id, amount, due_date) VALUES (?, ?, DATE_ADD(CURDATE(), INTERVAL ? MONTH))");
                        $stmt->execute([$paymentId, $instAmount, $i]);
                    }
                }

                $db->commit();
                header("Location: /structure/payments");
            } catch (Exception $e) {
                $db->rollBack();
                die($e->getMessage());
            }
        }
    }
}
