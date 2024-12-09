<!DOCTYPE html>
<html>
<head>
    <title>Обновить предмет</title>
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

        label, .days label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
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

<h1>Обновить предмет</h1>

<form method="POST" action="update.php">
    <label for="subject">Название предмета:</label>
    <input type="text" id="subject" name="subject" required>

    <label for="cell_text">Новое значение для ячейки:</label>
    <input type="text" id="cell_text" name="cell_text" required>

    <div class="days">
        <label><input type="checkbox" name="monday"> Понедельник</label>
        <label><input type="checkbox" name="tuesday"> Вторник</label>
        <label><input type="checkbox" name="wednesday"> Среда</label>
        <label><input type="checkbox" name="thursday"> Четверг</label>
        <label><input type="checkbox" name="friday"> Пятница</label>
        <label><input type="checkbox" name="saturday"> Суббота</label>
        <label><input type="checkbox" name="sunday"> Воскресенье</label>
    </div>

    <input type="submit" value="Обновить">
</form>

<a href="admin.html" class="button_main">На Главную</a>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = $_POST['subject'];
    $cell_text = $_POST['cell_text'];
    $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

    $values = array_map(fn($day) => isset($_POST[$day]) ? "'$cell_text'" : "NULL", $days);

    $mysqli = new mysqli("db", "root", "example", "mydb");

    if ($mysqli->connect_error) {
        die("Ошибка подключения: " . $mysqli->connect_error);
    }

    $sql = "UPDATE retakes 
            SET monday = {$values[0]}, 
                tuesday = {$values[1]}, 
                wednesday = {$values[2]}, 
                thursday = {$values[3]}, 
                friday = {$values[4]}, 
                saturday = {$values[5]}, 
                sunday = {$values[6]} 
            WHERE subject = '$subject'";

    if ($mysqli->query($sql) === TRUE) {
        echo "<p>Предмет успешно обновлен.</p>";
    } else {
        echo "Ошибка: " . $mysqli->error;
    }

    $mysqli->close();
}
?>

</body>
</html>
