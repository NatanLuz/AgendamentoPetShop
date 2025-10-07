<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
function set_flash($msg, $type = 'info') {
    $_SESSION['_flash'] = ['msg' => $msg, 'type' => $type];
}
function flash() {
    if (isset($_SESSION['_flash'])) {
        $f = $_SESSION['_flash'];
        unset($_SESSION['_flash']);
        $class = $f['type'] === 'error' ? 'message-error' : ($f['type'] === 'success' ? 'message-success' : 'message-info');
        return '<div class="message ' . $class . '">' . htmlspecialchars($f['msg']) . '</div>';
    }
    return '';
}
?>