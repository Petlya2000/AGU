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
$sql = "SELECT * FROM `spr_region`";
    $all_regions = mysqli_query($con,$sql);
       
        // Если запись найдена, заполняем остальные поля формы
        if($row) {
            $fam = $row['Ankety_fam'];
            $name = $row['Ankety_name1'];
            $otch = $row['Ankety_otch'];
            $dob = $row['date_birth'];
            $id= $row['reg_id'];
            // Заполните остальные поля аналогичным образом
        }
    }

    // Проверяем, была ли отправлена форма обновления данных
    if(isset($_POST['update'])) {
        // Получаем обновленные данные из формы
        $ankety_id = mysqli_real_escape_string($con, $_POST['Ankety_id']);
      // Store the Ankety_fam in a "fam" variable
       $fam = mysqli_real_escape_string($con,$_POST['Ankety_fam']);
        // Store the Ankety_name1 in a "name" variable
        $name = mysqli_real_escape_string($con,$_POST['Ankety_name1']);
         // Store the Ankety_otch in a "otch" variable
        $otch = mysqli_real_escape_string($con,$_POST['Ankety_otch']);
        // Store the date_birth in a "dob" variable
       $dob = date('Y-m-d', strtotime(($_POST['dateofbirth'])));
        // Store the reg_id in a "id" variable
        $id = mysqli_real_escape_string($con,$_POST['Region']); 
        // Запрос на обновление данных в базе данных
        $sql_update = "UPDATE `ankety` SET `Ankety_fam`='$fam', `Ankety_name1`='$name', `Ankety_otch`='$otch', `date_birth`='$dob',
        `reg_id`='$id'
 WHERE `Ankety_id`='$ankety_id'";
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
      <select name="Region">
    <?php 
    while ($regions = mysqli_fetch_array(
                        $all_regions,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo  isset($id) ? $id : '';
                    // The value we usually set is the primary key
                ?>">
                    <?php echo $regions["reg_name"];
                        // To show the category name to the user
                    ?>
                </option>
            <?php 
                endwhile; 
                // While loop must be terminated
            ?>
</select>
        <br>
        <br>
        <input type="submit" value="Обновить" name="update">
    </form>
</body>
</html>
