<?php
 
    require_once 'conn.php';
     
    // mysqli_connect("servername","username","password","database_name")
  
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
    // The following code checks if the submit button is clicked 
    // and inserts the data in the database accordingly
    if(isset($_POST['submit']))
    {
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
        // Creating an insert query using SQL syntax and
        // storing it in a variable.
        $sql_insert = 
        "INSERT INTO `ankety`(`Ankety_fam`,`Ankety_name1`,`Ankety_otch`,`date_birth`, `reg_id`,`document`,`nationality_id`,`country_id`,`gender_id`,`vid_milit_serv_id`,`document_mil`,`tel_home`,`tel_mob`,`uch_zav_id`,`document_educ`,`srednbal,`trud_st`,`document_trud`,`language_id`,`LIVING`,`vip_letter`,`mother`,`father`)
            VALUES ('$fam','$name','$otch','$dob','$id','$doc','$id1','$id2','$id3','$id4','$doc_mil','$tel1','$tel2','$id5','$doc_edc','$sred','$q1','$doc_trd','$id6','$q2','$vip','$mother','$father')";
          
          // The following code attempts to execute the SQL query
          // if the query executes with no errors 
          // a javascript alert message is displayed
          // which says the data is inserted successfully
          if(mysqli_query($con,$sql_insert))
        {
            echo '<script>alert("Data added successfully")</script>';
        }
     }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html">
 <title>Ввод данных в анкету</title>
<h1>Ввод данных в анкету</h1>
</head>
<body>
    <form method="POST">
     <label>Фамилия студента:</label>
        <input type="text" name="Ankety_fam" required><br>
        <label>Имя студента:</label>
        <input type="text" name="Ankety_name1" required><br>
     <label>Отчество студента:</label>
        <input type="text" name="Ankety_otch" required><br>
     <label>Дата рождения:</label>
      <input type="date" name="dateofbirth" required> <br>
     <label>Регион</label>
     <select name="Region"><?php 
                // use a while loop to fetch data 
                // from the $all_categories variable 
                // and individually display as an option
                while ($regions = mysqli_fetch_array(
                        $all_regions,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $regions["id_region"];
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
      <label>Документ удостоверяющий личность:</label>
        <input type="text" name="document" required><br>
     <label>Национальность</label>
     <select name="Nationality"><?php 
                // use a while loop to fetch data 
                // from the $all_categories variable 
                // and individually display as an option
                while ($nationalities = mysqli_fetch_array(
                        $all_nationalities,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $nationalities["nation_id"];
                    // The value we usually set is the primary key
                ?>">
                    <?php echo $nationalities["nation_name"];
                        // To show the category name to the user
                    ?>
                </option>
            <?php 
                endwhile; 
                // While loop must be terminated
            ?>
        </select>
        <br>
     <label>Страна</label>
     <select name="Country"><?php 
                // use a while loop to fetch data 
                // from the $all_categories variable 
                // and individually display as an option
                while ($countries = mysqli_fetch_array(
                        $all_countries,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $countries["country_id"];
                    // The value we usually set is the primary key
                ?>">
                    <?php echo $countries["country_name"];
                        // To show the category name to the user
                    ?>
                </option>
            <?php 
                endwhile; 
                // While loop must be terminated
            ?>
        </select>
        <br>
     <label>Пол</label>
     <select name="Gender"><?php 
                // use a while loop to fetch data 
                // from the $all_categories variable 
                // and individually display as an option
                while ($genders = mysqli_fetch_array(
                        $all_genders,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $genders["gend_id"];
                    // The value we usually set is the primary key
                ?>">
                    <?php echo $genders["gend_name"];
                        // To show the category name to the user
                    ?>
                </option>
            <?php 
                endwhile; 
                // While loop must be terminated
            ?>
        </select>
        <br>
        <label>Военная служба</label>
     <select name="Milit_serve"><?php 
                // use a while loop to fetch data 
                // from the $all_categories variable 
                // and individually display as an option
                while ($vid_mili_services = mysqli_fetch_array(
                        $all_vid_mili_services,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $vid_mili_services["vid_milit_serv_id"];
                    // The value we usually set is the primary key
                ?>">
                    <?php echo $vid_mili_services["vid_milit_serv_name"];
                        // To show the category name to the user
                    ?>
                </option>
            <?php 
                endwhile; 
                // While loop must be terminated
            ?>
        </select>
        <br>
     <label>Документ о военной службе:</label>
        <input type="text" name="document_mil" required><br>
     <label>Домашний телефон:</label>
        <input type="text" name="Telhome" ><br>
     <label>Мобильный телефон:</label>
        <input type="text" name="Telmob" ><br>
     <label>Учебное заведение</label>
     <select name="Uch_zav"><?php 
                // use a while loop to fetch data 
                // from the $all_categories variable 
                // and individually display as an option
                while ($uch_zaves = mysqli_fetch_array(
                        $all_uch_zaves,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $uch_zaves["uch_zav_id"];
                    // The value we usually set is the primary key
                ?>">
                    <?php echo $uch_zaves["uch_zav_name"];
                        // To show the category name to the user
                    ?>
                </option>
            <?php 
                endwhile; 
                // While loop must be terminated
            ?>
        </select>
        <br>
     <label>Документ от учебного заведения:</label>
        <input type="text" name="document_educ" ><br>
     <label>Средний бал:</label>
        <input type="number" name="sredbal" min="0" step="0.1">
     <br>
     <label>Трудовой стаж</label>
       <br>
     <input type="radio" name="q1" value="0"> Нет<br>
     <input type="radio" name="q1" value="1"> Да<br>
      <br>
     <label>Данные о трудовом стаже:</label>
        <input type="text" name="document_trud" ><br>
     <label>Инностранный язык в школе</label>
        <select name="Language">
            <?php 
                // use a while loop to fetch data 
                // from the $all_categories variable 
                // and individually display as an option
                while ($languages = mysqli_fetch_array(
                        $all_languages,MYSQLI_ASSOC)):; 
            ?>
                <option value="<?php echo $languages["language_id "];
                    // The value we usually set is the primary key
                ?>">
                    <?php echo $languages["languages_name"];
                        // To show the category name to the user
                    ?>
                </option>
            <?php 
                endwhile; 
                // While loop must be terminated
            ?>
        </select>
        <br>
     <label>Нужда в общежитии</label>
       <br>
     <input type="radio" name="q2" value="0"> Нет<br>
     <input type="radio" name="q2" value="1"> Да<br>
      <br>
     <label>Документы на льготы(рекомендательные письма):</label>
        <input type="text" name="vip" ><br>
     <label>Данные о матери (ФИО, номер телефона):</label>
        <input type="text" name="Mother" ><br>
     <label>Данные об отце (ФИО, номер телефона):</label>
        <input type="text" name="Father" ><br>
      <br>
        <input type="submit" value="submit" name="submit">
    </form>
    <br>
 <form method="post" action="alldata.php">
<input id="submitover" type="submit" value="Показать всех"><b/>
</form>
</body>
</html>
