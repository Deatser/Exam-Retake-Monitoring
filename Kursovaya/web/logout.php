<?php
session_start();
session_destroy();
header("Location: login.html"); // Перенаправление на страницу входа после выхода
exit();
?>
