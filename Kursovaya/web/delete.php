<!DOCTYPE html>
<html>
<head>
    <title>Удалить предмет</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h1 {
            background-color: #333;
            color: #fff;
            padding: 20px;
        }

        form {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 300px;
            margin: 20px auto;
        }

				.button_main {
            background-color: #3f03af;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Удалить предмет</h1>
    <form method="POST" action="delete.php">
        <input type="text" name="subject" placeholder="Название предмета" required>
        <input type="submit" value="Удалить">
    </form>

		<a href="admin.html"class="button_main">На Главную</a>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $subject = $_POST['subject'];

        $mysqli = new mysqli("db", "root", "example", "mydb");

        if ($mysqli->connect_error) {
            die("Ошибка подключения: " . $mysqli->connect_error);
        }

        $sql = "DELETE FROM retakes WHERE subject = '$subject'";

        if ($mysqli->query($sql) === TRUE) {
            echo "<p>Предмет успешно удален.</p>";
        } else {
            echo "Ошибка: " . $mysqli->error;
        }

        $mysqli->close();
    }
    ?>
</body>
</html>
