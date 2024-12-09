<!DOCTYPE html>
<html>
<head>
    <title>Добавить предмет</title>
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

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
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

        .days label {
            display: inline-block;
            margin-right: 10px;
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

<h1>Добавить предмет</h1>

<form method="POST" action="create.php" onsubmit="return validateForm()">
    <label for="subject">Название предмета:</label>
    <input type="text" id="subject" name="subject" required>

    <label for="cell_text">Время и Место: </label>
    <input type="text" id="cell_text" name="cell_text">

    <div class="days">
        <label><input type="checkbox" name="monday"> Понедельник</label>
        <label><input type="checkbox" name="tuesday"> Вторник</label>
        <label><input type="checkbox" name="wednesday"> Среда</label>
        <label><input type="checkbox" name="thursday"> Четверг</label>
        <label><input type="checkbox" name="friday"> Пятница</label>
        <label><input type="checkbox" name="saturday"> Суббота</label>
        <label><input type="checkbox" name="sunday"> Воскресенье</label>
    </div>

    <input type="submit" value="Добавить">
</form>

<script>
function validateForm() {
    var checkboxes = document.querySelectorAll('.days input[type="checkbox"]');
    var isChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
    
    if (!isChecked) {
        alert('Пожалуйста, выберите хотя бы один день');
        return false;
    }
    return true;
}
</script>

<a href="admin.html" class="button_main">На Главную</a>

<!-- Кнопка запуска скрипта -->
<form method="POST" action="">
    <button type="submit" name="run_script" class="button_main">Сгенерировать время и место  </button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['run_script'])) {
        // Выполнение Python-скрипта
        $output = shell_exec('python3 write_info.py');
        echo "<script>updateCellText('$output');</script>";
        echo "<p>$output</p>";
    } else {
        // Обработка формы добавления записи
        $subject = $_POST['subject'];
        $cell_text = $_POST['cell_text'];
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        // Если поле 'cell_text' пустое, используем результат скрипта
        if (empty($cell_text)) {
            $output = shell_exec('python3 write_info.py');
            $values = array_map(fn($day) => isset($_POST[$day]) ? "'$output'" : "NULL", $days);
        } else {
            $values = array_map(fn($day) => isset($_POST[$day]) ? "'$cell_text'" : "NULL", $days);
        }

        $servername = "db";
        $username = "root";
        $password = "example";
        $dbname = "mydb";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Ошибка подключения: " . $conn->connect_error);
        }

        $sql = "INSERT INTO retakes (subject, monday, tuesday, wednesday, thursday, friday, saturday, sunday)
                VALUES ('$subject', " . implode(', ', $values) . ")";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Предмет успешно добавлен!</p>";
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}
?>

</body>

</html>
