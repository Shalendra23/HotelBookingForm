<?php
//destroys the $_SESSION variables
Session_start();
Session_destroy();
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>