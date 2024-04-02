<?php
require_once 'conn.php';
$sql_select = "SELECT * FROM ankety 
               INNER JOIN spr_region ON ankety.reg_id = spr_region.id_region 
               INNER JOIN gender ON ankety.gender_id = gender.gend_id 
               INNER JOIN nationality ON ankety.nationality_id = nationality.nation_id 
               ORDER BY ankety.Ankety_id ASC;";
$result = mysqli_query($con, $sql_select);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html">
    <title>Кратко об абитуриентах</title>
    <style>
        .fixed-form {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: white;
            z-index: 1000;
            padding: 10px;
            box-shadow: 0 -2px 5px rgba(0,0,0,.3);
        }
        .container {
          width:500px;
            padding-bottom: 200px; /* Увеличен размер подвала для размещения форм */
        }
    </style>
</head>
<body>
    <h1>Краткие анкетные данные об абитуриентах</h1>
    <div class="container">  
        <table class="table table-striped">
            <tr>  
                <th>ID</th>
                <th>Фамилия</th>  
                <th>Имя</th>  
                <th>Отчество</th>
                <th>Регион</th>
                <th>Дата рождения</th>
                <th>Пол</th>
                <th>Национальность</th>
            </tr>  
            <?php  
            if(mysqli_num_rows($result) > 0) {  
                while($row = mysqli_fetch_array($result)) {  
            ?>  
            <tr>  
                <td><?php echo $row["Ankety_id"]; ?></td>
                 <td><?php echo $row["Ankety_fam"]; ?></td>  
                <td><?php echo $row["Ankety_name1"]; ?></td>  
                <td><?php echo $row["Ankety_otch"]; ?></td>
                <td><?php echo $row["reg_name"]; ?></td>  
                <td><?php echo $row["date_birth"]; ?></td>  
                <td><?php echo $row["gend_name"]; ?></td> 
                <td><?php echo $row["nation_name"]; ?></td>
            </tr>  
            <?php  
                }  
            }  
            ?>  
        </table>  
    </div>  
    <div class="fixed-form">
        <form method="post" action="form.php">
            <input type="submit" value="Добавить запись">
        </form>
      
        <form method="post" action="read.php">
            <input type="text" name="nk" placeholder="ID абитуриента">
            <input type="submit" value="Читать...">
        </form>
      <form method="post" action="SortFam.php">
            <input type="text" name="nk" placeholder="Фамилия абитуриента">
            <input type="submit" value="Поиск по фамилии">
        </form>
      <form method="post" action="SortName.php">
            <input type="text" name="nk" placeholder="Имя абитуриента">
            <input type="submit" value="Поиск по Имени">
        </form>
        <form method="post" action="SortNation.php">
            <input type="text" name="nk" placeholder="Национальность абитуриента">
            <input type="submit" value="Поиск по национальности">
        </form>
        <form method="post" action="SortSredbal.php">
            <input type="number" name="nk" min="0" step="0.1" placeholder="средний бал абитуриента">
            <input type="submit" value="Поиск по среднему балу (>)">
        </form>
        <form method="post" action="SortData1.php">
            <input type="date" name="nk">
            <input type="submit" value="Поиск по дате (>)">
        </form>
        <form method="post" action="SortRegion.php">
            <input type="text" name="nk">
            <input type="submit" value="Поиск по региону">
        </form>
        <form method="post" action="delete.php">
            <input type="text" name="nk" placeholder="ID абитуриента">
            <input type="submit" value="Удалить">
        </form>
    </div>
    <script>
        window.onscroll = function() {
            var footer = document.querySelector('.fixed-form');
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                footer.style.position = 'relative';
            } else {
                footer.style.position = 'fixed';
            }
        };
    </script>
</body>
</html>
