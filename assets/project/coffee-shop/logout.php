<?php
/* ==========================================================
   logout.php
   Ends session and sends user back to login
   ========================================================== */

session_start();

session_unset();
session_destroy();

header("Location: login.php");
exit;