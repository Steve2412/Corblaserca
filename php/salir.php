<?php

require_once __DIR__ . '/sesion.php';

session_destroy();

'<script language="javascript">alert("Has cerrado sesión);</script>';
header("location: ../index.html");

exit();

?>