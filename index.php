<?php


// Подключение к базе данных
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Инициализация переменных
$ankety_name1 = '';
$ankety_otch = '';
$date_birth = '';
$obr_progr = '';
$vid_obr_name = '';
$fakultet_name = '';

// Получение данных из таблицы ankety при выборе фамилии
if (isset($_GET['ankety_id'])) {
    $ankety_id = $_GET['ankety_id'];
    $ankety_query = $conn->query("SELECT Ankety_name1, Ankety_otch, date_birth FROM ankety WHERE Ankety_id = $ankety_id");
    if ($ankety_query->num_rows > 0) {
        $ankety = $ankety_query->fetch_assoc();
        $ankety_name1 = $ankety['Ankety_name1'];
        $ankety_otch = $ankety['Ankety_otch'];
        $date_birth = $ankety['date_birth'];
    }
}

// Получение данных для выпадающих списков
$ankety = $conn->query("SELECT Ankety_id, Ankety_fam FROM ankety");
$napravleniya = $conn->query("SELECT napr_id, napr_name FROM perech_napr_spec");
$form_obuch = $conn->query("SELECT form_obuch_id, form_obuch_name FROM form_obuch");
$osn_obuch = $conn->query("SELECT osn_obuch_id, osn_obuch_name FROM osnov_obuch");
$sector_langv = $conn->query("SELECT sector_langv_id, name_langv_sect FROM sector_langv");


// Получение данных по выбранному направлению
if (isset($_GET['napr_id'])) {
    $napr_id = $_GET['napr_id'];
    $napr_query = $conn->query("SELECT obr_progr, vid_ush_zav.vid_uch_zav_name AS vid_obr_name, fakultety.name AS fakultet_name, perech_napr_spec.form_obuch_id FROM perech_napr_spec
                                JOIN vid_ush_zav ON perech_napr_spec.vid_obr_id = vid_ush_zav.vid_uch_zav_id
                                JOIN fakultety ON perech_napr_spec.facultet_id = fakultety.facultet_id
                                WHERE napr_id = $napr_id");
    if ($napr_query->num_rows > 0) {
        $napr = $napr_query->fetch_assoc();
        $obr_progr = $napr['obr_progr'];
        $vid_obr_name = $napr['vid_obr_name'];
        $fakultet_name = $napr['fakultet_name'];
        $form_obuch_id = $napr['form_obuch_id'];
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Получаем данные из формы
    $anket_id = $_POST['ankety_id'];
    $date_submission = $_POST['date_submission'];
    $napr_id = $_POST['napr_id'];

    $osn_obuch_id = $_POST['osn_obuch_id'];
    $sector_langv_id = $_POST['sector_langv_id'];
    $form_obuch_id = $_POST['form_obuch_id'];


    // Выключение внешних ключей
    $conn->query("SET foreign_key_checks = 0");
    // Подготовка SQL запроса для вставки данных
    $sql = "INSERT INTO abiturient (anket_id, date_vibor_napr, napr_id, form_obuc_id, osn_obuch_id, sect_langv_id) 
            VALUES ('$anket_id', '$date_submission', '$napr_id', '$form_obuch_id', '$osn_obuch_id', '$sector_langv_id')";

    // Выполнение SQL запроса
    if ($conn->query($sql) === TRUE) {
        
        $success = "Запись добавлена успешно!";
    } else {
        $errors[] = "Ошибка: " . $stmt->error;
    }

    // Включение внешних ключей
    $conn->query("SET foreign_key_checks = 1");

 
}



$conn->close();
?>



<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавление записи абитуриента</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        select, input[type="text"], input[type="date"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
        .success {
            color: green;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<div class="container">
    <?php if (isset($errors) && count($errors) > 0): ?>
        <div class="error">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <div class="success">
            <?= htmlspecialchars($success) ?>
            </br>
            </br>
            <a href="/"> Добавить еще</a>
        </div>
    <?php endif; ?>

    <form action="" method="GET">
        <div class="form-group">
            <label for="ankety_id">Фамилия:</label>
            <select id="ankety_id" name="ankety_id" required onchange="this.form.submit()">
                <option value="">Выберите фамилию</option>
                <?php while ($row = $ankety->fetch_assoc()): ?>
                    <option value="<?= $row['Ankety_id'] ?>" <?= isset($ankety_id) && $ankety_id == $row['Ankety_id'] ? 'selected' : '' ?>>
                        <?= $row['Ankety_id'] ?> - <?= $row['Ankety_fam'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
    </form>

    <form action="" method="GET">
        <input type="hidden" name="ankety_id" value="<?= isset($ankety_id) ? $ankety_id : '' ?>">
        <div class="form-group">
            <label for="ankety_name1">Имя:</label>
            <input type="text" id="ankety_name1" name="ankety_name1" value="<?= $ankety_name1 ?>" readonly>
        </div>
        <div class="form-group">
            <label for="ankety_otch">Отчество:</label>
            <input type="text" id="ankety_otch" name="ankety_otch" value="<?= $ankety_otch ?>" readonly>
        </div>
        <div class="form-group">
            <label for="date_birth">Дата рождения:</label>
            <input type="date" id="date_birth" name="date_birth" value="<?= $date_birth ?>" readonly>
        </div>
        <div class="form-group">
            <label for="napr_id">Направление:</label>
            <select id="napr_id" name="napr_id" required onchange="this.form.submit()">
                <option value="">Выберите направление</option>
                <?php while ($row = $napravleniya->fetch_assoc()): ?>
                    <option value="<?= $row['napr_id'] ?>" <?= isset($napr_id) && $napr_id == $row['napr_id'] ? 'selected' : '' ?>>
                        <?= $row['napr_name'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
    </form>

    <form action="" method="POST">
        <input type="hidden" name="ankety_id" value="<?= isset($ankety_id) ? $ankety_id : '' ?>">
        <input type="hidden" name="napr_id" value="<?= isset($napr_id) ? $napr_id : '' ?>">
        <div class="form-group">
            <label for="date_submission">Дата подачи док-тов:</label>
            <input type="date" id="date_submission" name="date_submission" required>
        </div>
        <div class="form-group">
            <label for="obr_progr">Программа:</label>
            <input type="text" id="obr_progr" name="obr_progr" value="<?= $obr_progr ?>" readonly>
        </div>
        <div class="form-group">
            <label for="vid_obr_name">Вид образования:</label>
            <input type="text" id="vid_obr_name" name="vid_obr_name" value="<?= $vid_obr_name ?>" readonly>
        </div>
        <div class="form-group">
            <label for="fakultet_name">Факультет:</label>
            <input type="text" id="fakultet_name" name="fakultet_name" value="<?= $fakultet_name ?>" readonly>
        </div>
        </br> 
        Без этих данных не сохраняет в БД 

        <div class="form-group">
            <label for="form_obuch_id">Форма обучения:</label>
            <select id="form_obuch_id" name="form_obuch_id" >
                <option value="">Выберите направление</option>
                <?php while ($row = $form_obuch ->fetch_assoc()): ?>
                    <option value="<?= $row['form_obuch_id'] ?>" <?= isset($form_obuch_id) && $form_obuch_id == $row['form_obuch_id'] ? 'selected' : '' ?>>
                        <?= $row['form_obuch_name'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
         <div class="form-group">
            <label for="osn_obuch_id">Основание обучения:</label>
            <select id="osn_obuch_id" name="osn_obuch_id" >
                <option value="">Выберите Основание</option>
                <?php while ($row = $osn_obuch ->fetch_assoc()): ?>
                    <option value="<?= $row['osn_obuch_id'] ?>" <?= isset($osn_obuch_id) && $osn_obuch_id == $row['osn_obuch_id'] ? 'selected' : '' ?>>
                        <?= $row['osn_obuch_name'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="sector_langv_id">Язык:</label>
            <select id="sector_langv_id" name="sector_langv_id" >
                <option value="">Выберите Язык</option>
                <?php while ($row = $sector_langv ->fetch_assoc()): ?>
                    <option value="<?= $row['sector_langv_id'] ?>" <?= isset($sector_langv_id) && $sector_langv_id == $row['sector_langv_id'] ? 'selected' : '' ?>>
                        <?= $row['name_langv_sect'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>



        <button type="submit">Добавить</button>
    </form>

</div>
</body>
</html>
