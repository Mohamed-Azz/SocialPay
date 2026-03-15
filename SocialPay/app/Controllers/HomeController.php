<?php
class HomeController {
    public function index() {
        header("Location: " . URLROOT . "/portal/login");
        exit();
    }
}
