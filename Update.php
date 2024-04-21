<?php
    require_once 'conn.php';
    
    // Проверяем, была ли отправлена форма
    if(isset($_POST['submit'])) {
        // Получаем ID записи из формы
        $ankety_id = mysqli_real_escape_string($con, $_POST['Ankety_id']);

        // Запрос к базе данных для получения информации о записи по ее ID
        $sql_select = "SELECT * FROM `ankety` WHERE `Ankety_id`='$ankety_id'";
        $result = mysqli_query($con, $sql_select);
        $row = mysqli_fetch_assoc($result);

        // Если запись найдена, заполняем остальные поля формы
        if($row) {
            $fam = $row['Ankety_fam'];
            $name = $row['Ankety_name1'];
            $otch = $row['Ankety_otch'];
            $dob = $row['date_birth'];
            // Заполните остальные поля аналогичным образом
        }
    }

    // Проверяем, была ли отправлена форма обновления данных
    if(isset($_POST['update'])) {
        // Получаем обновленные данные из формы
        $ankety_id = mysqli_real_escape_string($con, $_POST['Ankety_id']);
        $fam = mysqli_real_escape_string($con, $_POST['Ankety_fam']);
        $name = mysqli_real_escape_string($con, $_POST['Ankety_name1']);
                $otch = mysqli_real_escape_string($con,$_POST['Ankety_otch']);
        $dob = date('Y-m-d', strtotime(($_POST['dateofbirth'])));
        // Получите остальные данные аналогичным образом

        // Запрос на обновление данных в базе данных
        $sql_update = "UPDATE `ankety` SET `Ankety_fam`='$fam', `Ankety_name1`='$name', `Ankety_otch`='$otch' WHERE `Ankety_id`='$ankety_id'";
        if(mysqli_query($con, $sql_update)) {
            echo '<script>alert("Data updated successfully")</script>';
        } else {
            echo '<script>alert("Error updating data")</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
</head>
<body>
    <h1>Update Record</h1>
    <form method="POST">
        <label>ID записи для обновления:</label>
        <input type="text" name="Ankety_id" required><br>
        <input type="submit" value="Получить данные" name="submit">
    </form>

    <br>

    <form method="POST">
        <label>ID записи:</label>
        <input type="text" name="Ankety_id" value="<?php echo isset($ankety_id) ? $ankety_id : ''; ?>" readonly><br>
        <label>Фамилия абитуриента:</label>
        <input type="text" name="Ankety_fam" value="<?php echo isset($fam) ? $fam : ''; ?>" required><br>
    <label>Имя абитуриента:</label>
        <input type="text" name="Ankety_name1" value="<?php echo isset($name) ? $name : ''; ?>"required><br>
     <label>Отчество абитуриента:</label>
        <input type="text" name="Ankety_otch" value="<?php echo isset($otch) ? $otch : ''; ?>"required><br>
     <label>Дата рождения:</label>
      <input type="date" name="dateofbirth" value="<?php echo isset($dob) ? $dob : ''; ?>"required> <br>
        <input type="submit" value="Обновить" name="update">
    </form>
</body>
</html>
