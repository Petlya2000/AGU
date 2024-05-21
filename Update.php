<?php
    require_once 'conn.php';
	
	$sql= "SELECT * FROM spr_region";
	$all_regions= mysqli_query($con,$sql);
   // Get all the categories from category table
    $sql = "SELECT * FROM `spr_region`";
    $all_regions = mysqli_query($con,$sql);
    $sql1 = "SELECT * FROM `nationality`";
    $all_nationalities = mysqli_query($con,$sql1);
   $sql2 = "SELECT * FROM `countries`";
    $all_countries = mysqli_query($con,$sql2);
     $sql3 = "SELECT * FROM `gender`";
    $all_genders = mysqli_query($con,$sql3);
$sql4 = "SELECT * FROM `vid_mili_serv`";
    $all_vid_mili_services = mysqli_query($con,$sql4);
 $sql5 = "SELECT * FROM `uch_zav`";
    $all_uch_zaves = mysqli_query($con,$sql5);
$sql6 = "SELECT * FROM `languages`";
    $all_languages = mysqli_query($con,$sql6);
$sql7 = "SELECT * FROM `languages`";
    $all_languages = mysqli_query($con,$sql6);
    // Проверяем, была ли отправлена форма
    if(isset($_POST['submit'])) {
        // Получаем ID записи из формы
        $ankety_id = mysqli_real_escape_string($con, $_POST['Ankety_id']);


		

        // Запрос к базе данных для получения информации о записи по ее ID
        $sql_select = "SELECT * FROM ankety 
               INNER JOIN spr_region ON ankety.reg_id = spr_region.id_region 
               INNER JOIN gender ON ankety.gender_id = gender.gend_id 
               INNER JOIN nationality ON ankety.nationality_id = nationality.nation_id 
               WHERE `Ankety_id`='$ankety_id'";
        $result = mysqli_query($con, $sql_select);
        $row = mysqli_fetch_assoc($result);
		
		// $sql= "SELECT * FROM 'spr_region'";
        // $all_regions= mysqli_query($con,$sql);
		
        // Если запись найдена, заполняем остальные поля формы
        if($row) {
            $fam = $row['Ankety_fam'];
            $name = $row['Ankety_name1'];
            $otch = $row['Ankety_otch'];
            $dob = $row['date_birth'];
            $id= $row['reg_id'];
            $doc = $row['document'];
		$id1= $row['nationality_id'];
		$id2= $row['country_id'];
		$id3= $row['gender_id'];
		$id4= $row['vid_milit_serv_id'];
		$doc_mil=$row['document_mil'];
		$tel1=$row['tel_home'];
		$tel2=$row['tel_mob'];
		$id5=$row[`uch_zav_id`];
		$doc_edc=$row[`document_educ`];
            $q1=$row['trud_st'];
            $sred=$row['srednbal'];
			// $id=$row['reg_id'];

            // Заполните остальные поля аналогичным образом
        }
    }

    // Проверяем, была ли отправлена форма обновления данных
    if(isset($_POST['update'])) {
		if(isset($_POST['q1'])){
       $fam = mysqli_real_escape_string($con,$_POST['Ankety_fam']);
        $name = mysqli_real_escape_string($con,$_POST['Ankety_name1']);
        $otch = mysqli_real_escape_string($con,$_POST['Ankety_otch']);
       $dob = date('Y-m-d', strtotime(($_POST['dateofbirth'])));
        $id = mysqli_real_escape_string($con,$_POST['Region']); 
       $doc = mysqli_real_escape_string($con,$_POST['document']);
	        $id1 = mysqli_real_escape_string($con,$_POST['Nationality']); 
		 $id2 = mysqli_real_escape_string($con,$_POST['Country']);
        $id3 = mysqli_real_escape_string($con,$_POST['Gender']);
        $id4 = mysqli_real_escape_string($con,$_POST['Milit_serve']);
       $doc_mil = mysqli_real_escape_string($con,$_POST['document_mil']);
       $tel1 = mysqli_real_escape_string($con,$_POST['Telhome']);
       $tel2 = mysqli_real_escape_string($con,$_POST['Telmob']);
        $id5 = mysqli_real_escape_string($con,$_POST['Uch_zav']);
       $doc_edc = mysqli_real_escape_string($con,$_POST['document_educ']);
			 $q1=$_POST['q1'];
      $sred=$_POST['sredbal'];
        
        // Запрос на обновление данных в базе данных
        $sql_update = "UPDATE `ankety` SET `Ankety_fam`='$fam', `Ankety_name1`='$name', `Ankety_otch`='$otch', `date_birth`='$dob',`trud_st`='$q1',`reg_id`='$id',`document`='$doc',
`nationality_id`='$id1',`country_id`='$id2',`gender_id`='$id3',`vid_milit_serv_id`='$id3',`document_mil`='$doc_mil',`tel_home`='$tel1',`tel_mob`='$tel2',
`trud_st`='$q1',`srednbal`='$sred'
 WHERE `Ankety_id`='$ankety_id'";
        if(mysqli_query($con, $sql_update)) {
            echo '<script>alert("Data updated successfully")</script>';
        } else {
            echo '<script>alert("Error updating data")</script>';
        }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
	<script>
      function check() {
         var confirmed = confirm("Вы уверены?");
         return confirmed;
      }
 </script>
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
     <label>Регион</label>
     <select name="Region">
    <?php 
    while ($regions = mysqli_fetch_array(
                        $all_regions,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $regions["id_region"]?>" 
					<?php echo (isset($id) && $id == $regions["id_region"]) ? 'selected' : '';
                    // The value we usually set is the primary key
					?>
				>
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
      <label>Документ удостоверяющий личность:</label>
        <input type="text" name="document" value="<?php echo isset($doc) ? $doc : ''; ?>" required><br>
	    <label>Национальность</label>
     <select name="Nationality"><?php 
                while ($nationalities = mysqli_fetch_array(
                        $all_nationalities,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $nationalities["nation_id"]?>"
					<?php echo (isset($id1) && $id1 ==$nationalities["nation_id"]) ? 'selected' : '';
                ?>
			>
                    <?php echo $nationalities["nation_name"];
                    ?>
                </option>
            <?php 
                endwhile; 
            ?>
        </select>
        <br>
	    <label>Страна</label>
     <select name="Country"><?php 
                while ($countries = mysqli_fetch_array(
                        $all_countries,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $countries["country_id"]?>"
					<?php echo (isset($id2) && $id2==$countries["country_id"]) ? 'selected' : '';
                ?>
			>
                    <?php echo $countries["country_name"];
                    ?>
                </option>
            <?php 
                endwhile; 
            ?>
        </select>
        <br>
	    <label>Пол</label>
     <select name="Gender"><?php 
                         while ($genders = mysqli_fetch_array(
                        $all_genders,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $genders["gend_id"]?>"
			<?php echo (isset($id3) && $id3=$genders["gend_id"]) ? 'selected' : '';
                ?>
				 >
                    <?php echo $genders["gend_name"];
                    ?>
                </option>
            <?php 
                endwhile; 
            ?>
        </select>
        <br>
	    <label>Военная служба</label>
     <select name="Milit_serve"><?php 
                       while ($vid_mili_services = mysqli_fetch_array(
                        $all_vid_mili_services,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $vid_mili_services["vid_milit_serv_id"]?>"
				<?php echo (isset($id4) && $id4=$vid_mili_services["vid_milit_serv_id"]) ? 'selected' :'';
                ?>
			>
                    <?php echo $vid_mili_services["vid_milit_serv_name"];
                    ?>
                </option>
            <?php 
                endwhile; 
            ?>
        </select>
        <br>
	     <label>Документ о военной службе:</label>
        <input type="text" name="document_mil" value="<?php echo isset($doc_mil) ? $doc_mil: '';?>" required><br>
     <label>Домашний телефон:</label>
        <input type="text" name="Telhome" value="<?php echo isset($tel1) ? $tel1: '';?>" required><br>
     <label>Мобильный телефон:</label>
        <input type="text" name="Telmob" value="<?php echo isset($tel2) ? $tel2: '';?>" required><br>
	    <label>Средний бал:</label>
        <input type="number" name="sredbal" min="0" step="0.1" value="<?php echo isset($sred) ? $sred : ''; ?>"required>
     <br>
	    <label>Трудовой стаж</label>
       <br>
     <input type="radio" name="q1" value="0"<?php echo (isset($q1) && $q1 == 0 ) ? ' checked' : '';?>> Нет<br>
     <input type="radio" name="q1" value="1"<?php echo (isset($q1) && $q1 == 1 ) ? ' checked' : '';?>> Да<br>
      <br>
        <br>
        <input type="submit" value="Обновить" name="update">
    </form>
</body>
	<form method='post' action='alldata1.php'><b/>
<input id='submitread'  type='submit' value="Вернуться на главную"><b/><b/>
</form>
<form method="post" action="form.php">
<input id="submitback" type="submit" value="К форме">
</html>
