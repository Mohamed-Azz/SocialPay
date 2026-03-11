<?php
class HomeController {
    public function index() {
        header("Location: /portal/login");
        exit();
    }
}
