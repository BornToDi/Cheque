<?php
// Legacy pages assign their session values explicitly after registration.
if (!function_exists('session_register')) {
    function session_register() {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        return true;
    }
}

function cbrms_pdo() {
    $parts = explode(':', aibl_DB_HOST, 2);
    $dsn = 'mysql:host='.$parts[0].';port='.(isset($parts[1])?$parts[1]:'3306').';dbname='.aibl_DB_BASE;
    return new PDO($dsn, aibl_DB_USER, aibl_DB_PASS);
}
