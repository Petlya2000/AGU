<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html">
<title>Удалить</title>
</head>
<body>
<?php
require_once 'conn.php';
$id = $_REQUEST['nk'];
if (!($id)) {
  echo("Введите номер абитуриента");
}
else {
$sql_select = "DELETE FROM ankety WHERE Ankety_id='$id';";
$result = mysqli_query($con,$sql_select);
if (($result)) {
  echo("Запись $id удалена"):
    }
else { echo ("Запись не удалена"); }
}
?>
<form method='post' action='alldata.php'><b/>
<input id='submitread'  type='submit' value="На главную"><b/><b/>
</form>
<form method="post" action="form.php">
<input id="submitback" type="submit" value="К форие">
</form>
</body>
</html>
