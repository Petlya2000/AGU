<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html">
<title>Сортировка по дате</title>
</head>
<body>
<h1>Сортировка по дате</h1>
<?php
require_once 'conn.php';
$data = $_REQUEST['nk'];
if (!($data)) {
  echo("Введите необходимую дату");
}
else
{
$sql_select ="SELECT * FROM ankety INNER JOIN spr_region ON ankety.reg_id = spr_region.id_region INNER JOIN gender ON ankety.gender_id = gender.gend_id 
INNER JOIN languages ON ankety.language_id = languages.language_id INNER JOIN nationality ON ankety.nationality_id = nationality.nation_id
INNER JOIN countries ON ankety.country_id = countries.country_id
INNER JOIN uch_zav ON ankety.uch_zav_id = uch_zav.uch_zav_id INNER JOIN vid_mili_serv ON ankety.vid_milit_serv_id = vid_mili_serv.vid_milit_serv_id WHERE ankety.date_birth>'2000.01.05';";
  $result = mysqli_query($con,$sql_select);
?>
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
        if(mysqli_num_rows($result)=0){
          echo ("Таких записей нейт");}
          else {
            while($row=mysqli_fetch_array($result))
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
