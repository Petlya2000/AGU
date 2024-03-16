<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html">
<title>Подробные данные</title>
</head>
<body>
<?php
require_once 'connect.php';
$id = $_REQUEST['nk'];
if (!($id)) {
  echo("Введите номер студента");
}
else {
$sql_select = "SELECT * FROM ankety INNER JOIN spr_region ON ankety.reg_id = spr_region.id_region INNER JOIN gender ON ankety.gender_id = gender.gend_id 
INNER JOIN languages ON ankety.language_id = languages.language_id INNER JOIN nationality ON ankety.nationality_id = nationality.nation_id
INNER JOIN uch_zav ON ankety.uch_zav_id = uch_zav.uch_zav_id INNER JOIN vid_mili_serv ON ankety.vid_mili_serv_id = vid_mili_serv.vid_mili_serv_id WHERE Ankety_id='$id'";
$result = mysqli_query($conn,$sql_select);
$row = mysqli_fetch_array($result);
if($row) { printf("<p><b>Номер студента: ".$row['Ankety_id']."</b></p><p><b>Фамилия : ".$row['Ankety_fam']."</b></p><p><b>Имя : ".$row['Ankety_name1']."</b></p><p><b>Отчество : ".$row['Ankety_otch']."</b></p><p><b>Пол : ".$row['gend_name']."</b></p><p><b>Паспорт: ".$row['document']."</b></p><p><b>Дата рождения: ".$row['date_birth'].
  ."</b></p>----------------------------------------<b>"."</b></p><p><b>Страна: ".$row['country_nam']."</b></p><p><b>Регион: ".$row['reg_name']."</b></p><p><b>Национальность: ".$row["nation_name"]
  ."</b></p>----------------------------------------<b>"."</b></p><p><b>Страна: ".$row['Ankety_id']."</b></p><p><b>Фамилия студента: ".$row['Ankety_fam']."</b></p><p><b>Имя студента: ".$row['Ankety_name1']."</b></p><p><b>Отчество студента: ".$row['Ankety_otch'].
  ."</b></p>----------------------------------------<b>".) }
else { echo ("Такой записи в базе нет"); }
}
?>
<form method='post' action='alldata.php'><b/>
<input id='submitread'  type='submit' value="Вернуться к поиску"><b/><b/>
</form>
<form method="post" action="form.php">
<input id="submitback" type="submit" value="На главную">
</form>
</body>
</html>
