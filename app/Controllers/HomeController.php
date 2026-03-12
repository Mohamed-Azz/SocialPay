<?php
class HomeController {
    public function index() {
        // Only redirect if not already at the destination
        if ($_SERVER['REQUEST_URI'] == '/') {
            header("Location: /portal/login");
            exit();
        }
    }
}
