<?php
class StructureController {
    public function __construct() {
        if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['accountant', 'manager', 'admin'])) {
            header("Location: " . URLROOT . "/auth/login");
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['request_ids'])) {
            $requestIds = $_POST['request_ids'];
            $totalAmount = 0;
            $beneficiaryCount = count($requestIds);
            $fees = $_POST['total_fees'] ?? 0;

            $db = Database::getInstance();
            $db->beginTransaction();
            try {
                // Create Virement record
                $stmt = $db->prepare("INSERT INTO virements (beneficiary_count, total_amount, bank_fees, transfer_date, beneficiary_ids) VALUES (?, ?, ?, CURDATE(), ?)");
                $beneficiaryIdsStr = implode(',', $requestIds);

                // First calculate total amount
                foreach ($requestIds as $rid) {
                    $s = $db->prepare("SELECT g.amount FROM requests r JOIN grants g ON r.grant_id = g.id WHERE r.id = ?");
                    $s->execute([$rid]);
                    $totalAmount += $s->fetchColumn();
                }

                $stmt->execute([$beneficiaryCount, $totalAmount, $fees, $beneficiaryIdsStr]);
                $virementId = $db->lastInsertId();

                foreach ($requestIds as $rid) {
                    $s = $db->prepare("SELECT g.amount, g.installments_count, g.repayment_percentage FROM requests r JOIN grants g ON r.grant_id = g.id WHERE r.id = ?");
                    $s->execute([$rid]);
                    $grant = $s->fetch();
                    $amount = $grant['amount'];

                    // Insert individual payment
                    $stmtP = $db->prepare("INSERT INTO payments (request_id, user_id, amount, bank_fees, payment_date, reference_number, virement_id) VALUES (?, ?, ?, 0, CURDATE(), ?, ?)");
                    $ref = 'PAY-' . time() . '-' . $rid;
                    $stmtP->execute([$rid, $_SESSION['user_id'], $amount, $ref, $virementId]);
                    $paymentId = $db->lastInsertId();

                    // Update mandate budget
                    $stmtM = $db->prepare("UPDATE mandates SET budget = budget - ? WHERE is_active = 1");
                    $stmtM->execute([$amount]);

                    // Create installments if loan
                    if ($grant['installments_count'] > 0) {
                        $totalRepay = $amount * ($grant['repayment_percentage'] / 100);
                        $instAmount = $totalRepay / $grant['installments_count'];

                        for ($i = 1; $i <= $grant['installments_count']; $i++) {
                            $stmtI = $db->prepare("INSERT INTO installments (payment_id, amount, due_date) VALUES (?, ?, DATE_ADD(CURDATE(), INTERVAL ? MONTH))");
                            $stmtI->execute([$paymentId, $instAmount, $i]);
                        }
                    }
                }

                // Also subtract total fees from active mandate
                $stmtF = $db->prepare("UPDATE mandates SET budget = budget - ? WHERE is_active = 1");
                $stmtF->execute([$fees]);

                $db->commit();
                header("Location: " . URLROOT . "/structure/virements");
            } catch (Exception $e) {
                $db->rollBack();
                die($e->getMessage());
            }
        }
    }

    public function virements() {
        $db = Database::getInstance();
        $stmt = $db->query("SELECT * FROM virements ORDER BY created_at DESC");
        $virements = $stmt->fetchAll();
        require_once 'app/Views/admin/virements.php';
    }

    public function printVirement() {
        if (isset($_GET['id'])) {
            $db = Database::getInstance();
            $stmt = $db->prepare("SELECT * FROM virements WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            $virement = $stmt->fetch();

            $stmt = $db->prepare("SELECT p.*, e.nom_ar, e.prenom_ar, e.num_compte, g.name as grant_name FROM payments p JOIN requests r ON p.request_id = r.id JOIN employees e ON r.employee_id = e.id JOIN grants g ON r.grant_id = g.id WHERE p.virement_id = ?");
            $stmt->execute([$_GET['id']]);
            $details = $stmt->fetchAll();

            require_once 'app/Views/admin/virement_print.php';
        }
    }
}
