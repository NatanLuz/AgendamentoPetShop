<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
function is_logged_in() {
    return !empty($_SESSION['user']);
}
function require_login() {
    if (!is_logged_in()) {
        header('Location: login.php');
        exit;
    }
}
function login_user($user) {
    $_SESSION['user'] = $user;
}
function logout_user() {
    unset($_SESSION['user']);
}
function current_user() {
    return $_SESSION['user'] ?? null;
}
?>