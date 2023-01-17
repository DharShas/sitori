<?php
    session_start();
    $_SESSION = [];
    session_unset();
    session_destroy();

    setcookie('set','', time()-3600);
    setcookie('ket','', time()-3600);

    header("location: login.php");
    exit;

?>