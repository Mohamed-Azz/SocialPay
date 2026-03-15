<?php
require_once 'app/Models/User.php';

class AuthController {
    public function login() {
        require_once 'app/Views/auth/login.php';
    }

    public function postLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new User();
            $user = $userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password']) && $user['is_active']) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];

                header("Location: " . URLROOT . "/admin/dashboard");
                exit();
            } else {
                $_SESSION['error'] = "بيانات غير صحيحة أو حساب معطل";
                header("Location: " . URLROOT . "/auth/login");
                exit();
            }
        }
    }

    public function logout() {
        session_destroy();
        header("Location: " . URLROOT . "/auth/login");
        exit();
    }
}
