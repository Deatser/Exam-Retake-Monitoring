<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.html");
    exit();
}
$isAdmin = $_SESSION["username"] === "admin";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список пересдач</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            border: 1px solid #ddd;
            text-align: left;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        h1 {
            background-color: #333;
            color: #fff;
            padding: 20px;
        }

        .button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button_exit {
            background-color: #af0303;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button_main, .button_logout {
            background-color: #3f03af;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            margin: 10px;
        }

        .button_main:hover, .button_logout:hover {
            background-color: #5a08ff;
        }
    </style>
</head>
<body>
    <h1>Список пересдач</h1>

    <?php if ($isAdmin): ?>
        <a href="admin.html" class="button_main">Админская</a>
    <?php endif; ?>
    <a href="read.php" class="button">Посмотреть пересдачу по предмету</a>
    <a href="logout.php" class="button_exit">Выйти</a>

    <?php
    $servername = "db";
    $username = "root";
    $password = "example";
    $dbname = "mydb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM retakes";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Предмет</th>
                    <th>Понедельник</th>
                    <th>Вторник</th>
                    <th>Среда</th>
                    <th>Четверг</th>
                    <th>Пятница</th>
                    <th>Суббота</th>
                    <th>Воскресенье</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['subject']}</td>
                    <td>" . htmlspecialchars($row['monday'] ?? '') . "</td>
                    <td>" . htmlspecialchars($row['tuesday'] ?? '') . "</td>
                    <td>" . htmlspecialchars($row['wednesday'] ?? '') . "</td>
                    <td>" . htmlspecialchars($row['thursday'] ?? '') . "</td>
                    <td>" . htmlspecialchars($row['friday'] ?? '') . "</td>
                    <td>" . htmlspecialchars($row['saturday'] ?? '') . "</td>
                    <td>" . htmlspecialchars($row['sunday'] ?? '') . "</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Нет записей в базе данных.</p>";
    }

    $conn->close();
    ?>


</body>
</html>
