<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'university_db';

$conn = new mysqli($host, $user, $pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $f_name = $conn->real_escape_string($_POST['first_name']);
    $l_name = $conn->real_escape_string($_POST['last_name']);
    $group = $conn->real_escape_string($_POST['group_name']);
    $hobby = $conn->real_escape_string($_POST['hobby']);
    $langs = $conn->real_escape_string($_POST['programming_languages']);

    $sql_insert = "INSERT INTO students (first_name, last_name, group_name, hobby, programming_languages) 
                   VALUES ('$f_name', '$l_name', '$group', '$hobby', '$langs')";
    
    if ($conn->query($sql_insert) === TRUE) {
        echo "<script>alert('Студента додано успішно!');</script>";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Лабораторна робота: БД</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        form { background: #f9f9f9; padding: 20px; border: 1px solid #ddd; max-width: 400px; }
        input { width: 100%; margin-bottom: 10px; padding: 8px; box-sizing: border-box; }
        button { background-color: #4CAF50; color: white; padding: 10px 15px; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <h2>Додати студента</h2>
    <form method="POST" action="">
        <label>Ім'я:</label>
        <input type="text" name="first_name" required>
        
        <label>Прізвище:</label>
        <input type="text" name="last_name" required>
        
        <label>Група:</label>
        <input type="text" name="group_name" required>
        
        <label>Хобі:</label>
        <input type="text" name="hobby">
        
        <label>Мови програмування:</label>
        <input type="text" name="programming_languages">
        
        <button type="submit">Зберегти</button>
    </form>

    <h2>Список студентів</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Ім'я</th>
            <th>Прізвище</th>
            <th>Група</th>
            <th>Хобі</th>
            <th>Мови програмування</th>
        </tr>
        <?php
        $sql_select = "SELECT * FROM students ORDER BY student_id DESC";
        $result = $conn->query($sql_select);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["student_id"] . "</td>
                        <td>" . $row["first_name"] . "</td>
                        <td>" . $row["last_name"] . "</td>
                        <td>" . $row["group_name"] . "</td>
                        <td>" . $row["hobby"] . "</td>
                        <td>" . $row["programming_languages"] . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Записів немає</td></tr>";
        }
        $conn->close();
        ?>
    </table>

</body>
</html>
