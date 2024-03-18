<?php
    require_once 'conn.php';
   $sql_select="SELECT * FROM ankety INNER JOIN spr_region ON ankety.reg_id = spr_region.id_region INNER JOIN gender ON ankety.gender_id = gender.gend_id INNER JOIN nationality ON ankety.nationality_id = nationality.nation_id ORDER BY ankety.Ankety_id ASC;";
  $result=mysqli_query($con,$sql_select);
?>
  
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html">
<title>Кратко о студентах</title></head>
<body>
    <h1>Краткие данные о студентах</h1>
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
                          if(mysqli_num_rows($result) > 0)  
                          {  
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
                            <form method="post" action="form.php">
<br>
  <input id="submitback" type="submit" value="Добавить запись">
</form>
    <br/>
                              <form method='post' action='read.php'><b>
<input id="Nknig" type='text' name='nk' placeholder="ID студента"><b><b>
<br>
<input id='submitread'  type='submit' value='Читать...'><b><b>
</form>
    <br/>
                                  <form method='post' action='SortNation.php'><b>
<input id="Nknig" type='text' name='nk' placeholder="национальность студента"><b><b>
<br>
<input id='submitnation'  type='submit' value='Читать...'><b><b>
</form>
    <form method='post' action='SortSredbal.php'><b>
<input id="Nknig" type='number' name='nk' min="0" step="0.1" placeholder="средний бад студента"><b><b>
<br>
<input id='submitnation'  type='submit' value=Поиск по сред балу(>)'><b><b>
</form>
    <br/>
    <br/>
    <form method='post' action='SortData1.php'><b>
<input id="Nknig" type='date' name='nk'><b><b>
<br>
<input id='submitdata'  type='submit' value='Поиск по дате (>)'><b><b>
</form>
    <br/>
    <form method='post' action='delete.php'><br/>
<input id="Nknig" type='text' name='nk' placeholder="Номер студента"><b><b>
<br>
<input id='submitdelete'  type='submit' value='Удалить'><b><b>
</body>
</html>
