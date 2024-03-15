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
       $dob = date('Y-m-d', strtotime($date_birth));
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
        // Creating an insert query using SQL syntax and
        // storing it in a variable.
        $sql_insert = 
        "INSERT INTO `ankety`(`Ankety_fam`,`Ankety_name1`,`Ankety_otch`,`date_birth`, `reg_id `,`document`,`nationality_id`,`country_id`,`gender_id`,`vid_milit_serv_id`,`document_mil`,`tel_home`,`tel_mob`,`uch_zav_id`,`document_educ`,`trud_st`,`document_trud`,`language_id`,`LIVING`,`vip_letter`,`mother`,`father`)
            VALUES ('$fam','$name','$otch','$dob','$id','$doc','$id1','$id2','$id3','$id4','$doc_mil','$tel1','$tel2','$id5','$doc_edc','$q1','$doc_trd','$id6','$q2','$vip','$mother','$father')";
          
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
