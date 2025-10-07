<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['_csrf_token'])) {
    $_SESSION['_csrf_token'] = bin2hex(random_bytes(16));
}
function csrf_field() {
    return '<input type="hidden" name="_csrf" value="' . htmlspecialchars($_SESSION['_csrf_token']) . '">';
}
function verify_csrf($token) {
    return isset($_SESSION['_csrf_token']) && hash_equals($_SESSION['_csrf_token'], $token);
}
?>