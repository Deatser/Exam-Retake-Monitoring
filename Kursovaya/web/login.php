<?php
session_start();

// Настройки подключения к базе данных (если требуется)
// $servername = "db";
// $username = "root";
// $password = "example";
// $dbname = "mydb";

// Обработка POST-запроса при отправке формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Проверка данных пользователя
    if ($username === "admin" && $password === "adminpass") {
        // Вход для администратора
        $_SESSION["username"] = $username;
        $_SESSION["role"] = "admin";
        header("Location: admin.html"); // Перенаправление на админскую панель
        exit();
    } elseif ($username === "student" && $password === "studentpass") {
        // Вход для студента
        $_SESSION["username"] = $username;
        $_SESSION["role"] = "student";
        header("Location: index.php"); // Перенаправление на пользовательскую панель
        exit();
    } else {
        // Неверные учетные данные
        echo "Неверное имя пользователя или пароль.";
    }
}
?>
