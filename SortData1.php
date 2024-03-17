<?php
require_once 'connect.php';
$data = $_REQUEST['nk'];
if (!($data)) {
  echo("Введите автора книги");
}
else {
   $sql_select="SELECT * FROM ankety INNER JOIN spr_region ON ankety.reg_id = spr_region.id_region INNER JOIN gender ON ankety.gender_id = gender.gend_id INNER JOIN nationality ON ankety.nationality_id = nationality.nation_id WHERE ankety.date_birth > '$data'ORDER BY ankety.Ankety_id ASC;";
$result = mysqli_query($conn,$sql_select);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html">
<title>Поиск по Дате</title>
</head>
<body>
    <h1>Сортировка по дате</h1>
    <br />  
           <div class="container" style="width:500px;">  
                <div class="table-responsive">  
                     <table class="table table-striped">  
                          <tr>  
                              <th> ID</th>
                              <th> Имя</th>  
                              <th> Фамилия</th>  
                              <th> Отчество</th>
                              <th> Регион</th>
                              <th> Дата рождения</th>
                              <th> Пол</th>
                              <th> Национальность</th>
                           </tr>  
                          <?php  
                          if(mysqli_num_rows($result) = 0)  
                          {  echo("Таких записей нет");}
                          else {
                               while($row = mysqli_fetch_array($result))  
                               {  
                          ?>  
                          <tr>  
                                   <td><?php echo $row["Ankety_id"];?></td>
                                <td><?php echo $row["Ankety_name1"];?></td>  
                               <td><?php echo $row["Ankety_fam"];?></td>  
                               <td><?php echo $row["Ankety_otch"]; ?></td>
                                 <td><?php echo $row["reg_name"];?></td>  
                               <td><?php echo $row["date_birth"];?></td>  
                               <td><?php echo $row["gend_name"]; ?></td> 
                            <td><?php echo $row["nation_name"]; ?></td>
                          </tr>  
                          <?php  
                               }  
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
           <br /> 
</body>
<form method='post' action='alldata.php'><b/>
<input id='submitread'  type='submit' value="Вернуться на главную"><b/><b/>
</form>
<form method="post" action="form.php">
<input id="submitback" type="submit" value="К форме">
</form>
</body>
</html>
