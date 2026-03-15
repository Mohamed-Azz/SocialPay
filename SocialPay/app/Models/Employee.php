<?php
class Employee {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function verify($ssn, $dob) {
        // Convert ddmmyyyy to YYYY-MM-DD
        $day = substr($dob, 0, 2);
        $month = substr($dob, 2, 2);
        $year = substr($dob, 4, 4);
        $formatted_dob = "$year-$month-$day";

        $stmt = $this->db->prepare("SELECT * FROM employees WHERE ssn = ? AND date_naissance = ?");
        $stmt->execute([$ssn, $formatted_dob]);
        return $stmt->fetch();
    }
}
