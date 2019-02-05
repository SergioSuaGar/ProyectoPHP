<?php
session_start();
unset($_SESSION['Usuario'][0]['Usuario']);
session_destroy();
header("Location: ../../index.php");
?>