<? 
    if(session_status() == PHP_SESSION_NONE) {
        session_set_cookie_params([
            'lifetime' => 0,
            'path' => '/',
            'secure' => isset($_SERVER['HTTPS']),
            'secure' => true,
            'samesite' => 'lax'
        ]);
        session_start();
    }

    if(!isset($_SESSION['user_id'])) {
        header('Location: /front_end/src/pages/login.php?redirect=' . urlencode($_SERVER['REQUEST_URI']));
        exit;
    }
?>