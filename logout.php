
<?php

session_save_path();
session_start();

session_destroy();
header('Location: login.php');
exit();

