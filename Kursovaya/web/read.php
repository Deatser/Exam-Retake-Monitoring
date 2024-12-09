<!DOCTYPE html>
<html>
<head>
    <title>Просмотр предмета</title>
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

        form {
            margin: 20px auto;
        }

        input[type="text"] {
            padding: 10px;
            width: 300px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Посмотреть пересдачи по предмету</h1>

    <form method="GET" action="read.php">
        <input type="text" name="subject" placeholder="Название предмета" required>
        <input type="submit" value="Найти">
    </form>

    <a href="index.php" class="button">Просмотреть таблицу</a>

    <?php
    if (isset($_GET['subject'])) {
        $subject = htmlspecialchars($_GET['subject']);

        $servername = "db";
        $username = "root";
        $password = "example";
        $dbname = "mydb";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Ошибка подключения: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT * FROM retakes WHERE subject = ?");
        $stmt->bind_param("s", $subject);
        $stmt->execute();
        $result = $stmt->get_result();

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
                        <td>" . htmlspecialchars($row['subject']) . "</td>
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
            echo "<p>Предмет не найден.</p>";
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
