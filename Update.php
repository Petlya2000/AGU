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
            $q1=$row['trud_st'];
            $sred=$row['srednbal'];
			// $id=$row['reg_id'];

            // Заполните остальные поля аналогичным образом
        }
    }

    // Проверяем, была ли отправлена форма обновления данных
    if(isset($_POST['update'])) {
		if(isset($_POST['q1'])&&isset($_POST['q2'])){
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
        // Store the document in a "doc" variable
       $doc = mysqli_real_escape_string($con,$_POST['document']);
              // Store the nationality_id in a "id1" variable
        $id1 = mysqli_real_escape_string($con,$_POST['Nationality']); 
      // Store the country_id in a "id2" variable
        $id2 = mysqli_real_escape_string($con,$_POST['Country']);
      // Store the gender_id in a "id3" variable
        $id3 = mysqli_real_escape_string($con,$_POST['Gender']);
      // Store the vid_milit_serv_id in a "id4" variable
        $id4 = mysqli_real_escape_string($con,$_POST['Milit_serve']);
      // Store the 	document_mil in a "doc_mil" variable
       $doc_mil = mysqli_real_escape_string($con,$_POST['document_mil']);
      // Store the tel_home in a "tel1" variable
       $tel1 = mysqli_real_escape_string($con,$_POST['Telhome']);
      // Store the tel_mob in a "tel2" variable
       $tel2 = mysqli_real_escape_string($con,$_POST['Telmob']);
      // Store the uch_zav_id in a "id5" variable
        $id5 = mysqli_real_escape_string($con,$_POST['Uch_zav']);
      // Store the document_educ in a "doc_edc" variable
       $doc_edc = mysqli_real_escape_string($con,$_POST['document_educ']);
      // Store the trud_st in a "q1" variable
        $q1=$_POST['q1'];
      // Store the 	document_trud in a "doc_trd" variable
       $doc_trd = mysqli_real_escape_string($con,$_POST['document_trud']);
      // Store the language_id in a "id6" variable
        $id6 = mysqli_real_escape_string($con,$_POST['Language']);
      // Store the LIVING in a "q2" variable
        $q2=$_POST['q2'];
      // Store the 	vip_letter in a "vip" variable
       $vip = mysqli_real_escape_string($con,$_POST['vip']);
      // Store the mother in a "mother" variable
       $mother = mysqli_real_escape_string($con,$_POST['Mother']);
      // Store the 	father in a "	father" variable
       $father= mysqli_real_escape_string($con,$_POST['Father']);
      $sred=$_POST['sredbal'];
        
        // Запрос на обновление данных в базе данных
        $sql_update = "UPDATE `ankety` SET `Ankety_fam`='$fam', `Ankety_name1`='$name', `Ankety_otch`='$otch', `date_birth`='$dob',`trud_st`='$q1',`reg_id`='$id',`document`='$doc',`srednbal`='$sred'
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
        <br>
	    <label>Средний бал:</label>
        <input type="number" name="sredbal" min="0" step="0.1" value="<?php echo isset($sred) ? $sred : ''; ?>"required>
     <br>
        <br>
        <input type="submit" value="Обновить" name="update">
    </form>
</body>
</html>
