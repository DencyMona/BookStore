<?php
session_start();
session_unset();
session_destroy();
header("Location: index.php"); // or index.php, depending on where you redirect after logout
exit;
?>
